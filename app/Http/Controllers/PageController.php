<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryPage;
use App\Models\ContactRequest;
use App\Models\FaqCategory;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\PageOrder;
use App\Models\PageSection;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Visitor;
use App\Notifications\ContactUsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $settings = Settings::get();
        $categories = Category::whereNull('parent_id')->with(['page', 'child' => function ($q) {
            $q->with([
                'parent' => function ($query) {
                    $query->with(['child', 'parent' => function ($qry) {
                        $qry->with('child', 'parent')->orderBy('name', 'ASC');
                    }])->orderBy('name', 'ASC');;
                },
                'child' => function ($query) {
                    $query->with(['child', 'parent' => function ($qry) {
                        $qry->with('child', 'parent')->orderBy('name', 'ASC');
                    }])->orderBy('name', 'ASC');;
                }
        ]);
        }])->orderBy('position', 'ASC')->get();
        $latestBlog = Blog::orderBy('id', 'DESC')->limit(3)->get();
        $brands = Brand::get();
        $testimonials = Testimonial::get();
        $footer = collect([
            'terms_conditions_page' => isset($settings['terms_conditions_page']) ?
            Page::where('id', $settings['terms_conditions_page'])->first() : null,
            'privacy_policy_page' => isset($settings['privacy_policy_page']) ?
            Page::where('id', $settings['privacy_policy_page'])->first() : null,
            'footer_1' => isset($settings['footer_1']) ?
            Page::where('id', $settings['footer_1'])->first() : null,
            'footer_2' => isset($settings['footer_2']) ?
            Page::where('id', $settings['footer_2'])->first() : null,
            'footer_3' => isset($settings['footer_3']) ?
            Page::where('id', $settings['footer_3'])->first() : null,
            'footer_4' => isset($settings['footer_4']) ?
            Page::where('id', $settings['footer_4'])->first() : null,
        ]);

        if ($request->ip) {
            Log::debug($request->ip);
            $response = Http::get("https://ipinfo.io/" . $request->ip . "?token=7409286b5cd411");

            $isVisited = Visitor::whereDate('created_at', date('d'))->where('ip_address', $request->ip)->first();
            if ($isVisited) {
                $isVisited->touch();
            }else{
                Visitor::create([
                    'ip_address' => $request->ip,
                    'user_agent' => visitor()->userAgent(),
                    'platform' => visitor()->platform(),
                    'device' => preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", visitor()->userAgent()) ? 'Mobile' : 'Desktop',
                    'browser' => visitor()->browser(),
                    'languages' => json_encode(visitor()->languages()),
                    'request' => json_encode(visitor()->request()),
                    'location' => $response->body(),
                ]);
            }
        }


        return response()->json([
            'status' => true,
            'data' => $settings,
            'categories' => $categories,
            'blog' => $latestBlog,
            'brands' => $brands,
            'testimonials' => $testimonials,
            'footer' => $footer,
        ]);
    }

    public function categoryPage(Request $request, $slug)
    {
        $category = Category::with('child')->where('slug', $slug)->first();

        if ($request->has('type') && $request->type == 'page') {
            $page = Page::with('category', 'maps', 'brands')->where('slug', $slug)->first();

            if ($page) {
                $page->order = PageOrder::where('page_id', $page->id)->groupBy('position')->get();

                foreach ($page->order as $key => $value) {
                    if ($value->type == 'image') {
                        $imageIds = PageOrder::where('page_id', $page->id)->where('position', $value->position)->get()->pluck('model_id');
                        $value->image = PageImage::whereIn('id', $imageIds)->get();
                    }
                }
                return response()->json([
                    'status' => true,
                    'data' => $page,
                    'category' => $page->category,
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Category not found',
            ]);
        }

        $page = Page::with(['maps', 'brands',
        'category' => function ($category) {
            $category->with(['parent' => function ($cat) {
                $cat->with('parent');
            }]);
        }])->where('category_id', $category->id)->first();

        if (!$page) {
            return response()->json([
                'status' => false,
                'message' => 'Page not found',
            ]);
        }

        $page->order = PageOrder::where('page_id', $page->id)->groupBy('position')->get();

        foreach ($page->order as $key => $value) {
            if ($value->type == 'image') {
                $imageIds = PageOrder::where('page_id', $page->id)->where('position', $value->position)->get()->pluck('model_id');
                $value->image = PageImage::whereIn('id', $imageIds)->get();
            }
        }
        // $page = Page::with('brands', 'sections')->where('category_id', $category->id)->first();

        return response()->json([
            'status' => true,
            'data' => $page,
            'category' => $category,
        ]);
    }

    public function page($slug)
    {
        $page = Page::with('brands', 'sections')->where('slug', $slug)->first();

        return response()->json([
            'status' => true,
            'data' => $page,
        ]);
    }

    public function faq()
    {
        $data = FaqCategory::with('faqs')->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
    public function ContactRequest(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|max:255',
                'subject' => 'required',
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $contact = ContactRequest::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            (new User)->forceFill([
                'name' => 'Xpro Group',
                'email' => 'sanjit@xprogroup.com.au',
            ])->notify(new ContactUsNotification($contact));

            return response()->json([
                'status' => true,
                'message' => 'Thank you for contacting us. We will reply your message as soon as possible.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function getSitemap()
    {
        return response()->json([
            'status' => true,
            'data' => file_get_contents(public_path('/sitemap.xml')),
        ]);
    }
}
