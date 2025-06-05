<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\PageMap;
use App\Models\PageOrder;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(Request $request) {
        $pages =  Page::where(function ($query) {
                $query->orWhere('title', 'like', "%". request('search') ."%");
                $query->orWhereHas('category', function ($q) {
                    $q->where('name', 'like', "%". request('search') ."%");
                });
        })
        ->orderBy('id', 'DESC')
        ->with(['brands', 'category' => function ($q) {
            $q->with(['parent' => function ($query) {
                $query->with('parent');
            }]);
        }]);

        if ($request->category) {
            $pages = $pages->whereHas('category', function ($q) use ($request) {
                $q->where('id', $request->category)
                ->orWhere('parent_id', $request->category)
                ->orWhereHas('parent', function ($q) use ($request) {
                    $q->where('id', $request->category)
                    ->orWhere('parent_id', $request->category);
                });
            });
        }

        $pages = $pages->paginate(request('limit') ?? 10);

        return $pages;
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'category_id' => 'required',
                // 'slug' => 'required|unique:category_pages,slug',
                'meta_title' => 'required|max:255',
                'meta_description' => 'required',
                'description' => 'required',
                'show_contact_form' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            if (Page::where('category_id', $request->category_id)->exists()) {
                return response()->json([
                    'status' => false,
                    'messages' => 'This subcategory already have pages',

                ], 500);
            }

            DB::beginTransaction();

            $page = Page::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'description' => $request->description,
                'brand_title' => $request->brand_title,
                'show_contact_form' => intval($request->show_contact_form),
            ]);

            PageSection::where('page_id', $page->id)->delete();

            $pageSection = [];
            if ($request->section_title && $request->section_description) {
                foreach ($request->section_title as $key => $value) {
                    if ($request->section_title[$key] && $request->section_title[$key] != '') {
                        $pageSection[] = PageSection::create([
                            'page_id' => $page->id,
                            'title' => $request->section_title[$key] ?? '',
                            'description' => $request->section_description[$key] ?? '',
                        ]);
                    }
                }
            }

            $pageMaps = [];
            if ($request->map_url) {
                foreach ($request->map_url as $key => $value) {
                        $pageMaps[] = PageMap::create([
                            'page_id' => $page->id,
                            'title' => $request->map_title[$key] ?? null,
                            'description' => $request->map_description[$key] ?? null,
                            'url' => $request->map_url[$key] ?? null,
                        ]);
                }
            }

            // $pageMaps = [];
            // if ($request->section_title && $request->section_description) {
            //     foreach ($request->section_title as $key => $value) {
            //         if ($request->section_title[$key] && $request->section_title[$key] != '') {
            //             $pageMaps[] = PageMap::create([
            //                 'page_id' => $page->id,
            //                 'title' => $request->section_title[$key] ?? '',
            //                 'description' => $request->section_description[$key] ?? '',
            //             ]);
            //         }
            //     }
            // }

            $pageImages = [];
            if ($request->page_image) {
                foreach ($request->page_image as $key => $values) {
                    foreach ($values as $i => $value) {
                        // Upload Image
                        $request->file("page_image.$key.$i");
                        $fileName = time().'_'.$request->file("page_image.$key.$i")->getClientOriginalName();
                        $request->file("page_image.$key.$i")->storeAs('uploads', $fileName, 'public');

                        $pageImages[$key][$i] = PageImage::create([
                            'page_id' => $page->id,
                            'image' => $fileName,
                            'title' => isset($request->image_title[$key][$i]) ? $request->image_title[$key][$i] : null,
                            'description' => isset($request->image_description[$key][$i]) ? $request->image_description[$key][$i] : null,
                            'alt' => isset($request->image_alt[$key][$i]) ? $request->image_alt[$key][$i] : null,
                            'link' => isset($request->image_link[$key][$i]) ? $request->image_link[$key][$i] : null,
                        ]);
                    }
                }
            }

            $sectionImageIds = [];
            $sectionPageIds = [];
            $sectionMapIds = [];
            if ($request->section_types) {
                foreach ($request->section_types as $key => $type) {
                    if ($type == 'image') {
                        if ($pageImages[$key]) {
                            foreach ($pageImages[$key] as $i => $pageImage) {
                                PageOrder::create([
                                    'page_id' => $page->id,
                                    'model_id' => $pageImage->id,
                                    'title' => $request->page_image_title[$key] ?? null,
                                    'type' => $type,
                                    'position' => $key,
                                ]);
                            }
                        }
                        $sectionImageIds[] = $pageImage->id;
                    }else if ($type == 'description') {
                        PageOrder::create([
                            'page_id' => $page->id,
                            'model_id' => $pageSection[count($sectionPageIds)]->id,
                            'type' => $type,
                            'position' => $key,
                        ]);
                        $sectionPageIds[] = $pageSection[count($sectionPageIds)];
                    } else if ($type == 'map') {
                        PageOrder::create([
                            'page_id' => $page->id,
                            'model_id' => $pageMaps[count($sectionMapIds)]->id,
                            'type' => $type,
                            'position' => $key,
                        ]);
                        $sectionMapIds[] = $pageMaps[count($sectionMapIds)];
                    }
                }
            }
            // foreach ($request->section_types as $key => $type) {
            //     PageOrder::create([
            //         'page_id' => $page->id,
            //         'model_id' => $type == 'image' ? $pageImages[count($sectionImageIds)]->id : $pageSection[count($sectionPageIds)]->id,
            //         'type' => $type,
            //         'position' => $key,
            //     ]);

            //     if ($type == 'image') {
            //         $sectionImageIds[] = $pageImages[count($sectionImageIds)];
            //     }else{
            //         $sectionPageIds[] = $pageSection[count($sectionPageIds)];
            //     }
            // }

            if ($request->has('page_brand_id')) {
                $arr = [];
                foreach ($request->page_brand_id as $key => $value) {
                    foreach (json_decode($value) as $k => $v) {
                        $arr[$k] = ['index' => $v->index];
                    }
                }

                Page::find($page->id)->brands()->detach();
                Page::find($page->id)->brands()->sync($arr);
            }

            // PageMap::create([
            //     'title' => $request->title,
            //     'description' => $request->description,
            //     'url' => $request->url,
            // ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'messages' => 'Page successfully created.',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        try {
            $data = Page::with('brands', 'sections')->where('id', $id)->first();
            // $categories = Category::where('id', $data->category_id)->get();
            // $categories = Category::where('parent_id', $data->parent_id)->get();
            // $categories = Category::where('parent_id', $data->parent_id)->get();
            $brands = Brand::get()->map(function ($brand) {
                return [
                    'value' => $brand->id,
                    'label' => $brand->name,
                ];
            });

            return response()->json([
                'status' => true,
                'data' => $data,
                'brands' => $brands,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $page = Page::with(['maps', 'brands',
        'category' => function ($category) {
            $category->with(['parent' => function ($cat) {
                $cat->with('parent');
            }]);
        }])->where('id', $id)->first();

        $page->order = PageOrder::where('page_id', $id)->groupBy('position')->get();

        foreach ($page->order as $key => $value) {
            if ($value->type == 'image') {
                $imageIds = PageOrder::where('page_id', $id)->where('position', $value->position)->get()->pluck('model_id');
                $value->image = PageImage::whereIn('id', $imageIds)->get();
            }
        }

        $brands = Brand::get()->map(function ($brand) {
            return [
                'value' => $brand->id,
                'label' => $brand->name,
            ];
        });

        return response()->json([
            'data' => $page,
            'brands' => $brands,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'category_id' => 'required',
                'meta_title' => 'required|max:255',
                'meta_description' => 'required',
                'description' => 'required',
                'show_contact_form' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            DB::beginTransaction();

            $page = Page::where('id', $id)->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'description' => $request->description,
                'brand_title' => $request->brand_title ?? '',
                'show_contact_form' => intval($request->show_contact_form),
            ]);

            if ($request->slug) {
                Category::where('id', $request->category_id)->update([
                    'slug' => $request->slug,
                ]);
            }


            $pageSection = [];
            PageSection::where('page_id', $id)->delete();
            if ($request->section_title && $request->section_description) {
                foreach ($request->section_title as $key => $value) {
                    if ($request->section_title[$key] && $request->section_title[$key] != '') {
                        $pageSection[] = PageSection::create([
                            'page_id' => $id,
                            'title' => $request->section_title[$key] ?? '',
                            'description' => $request->section_description[$key] ?? '',
                        ]);
                    }
                }
            }

            $pageMaps = [];
            PageMap::where('page_id', $id)->delete();
            if ($request->map_url) {
                foreach ($request->map_url as $key => $value) {
                    if ($request->map_url[$key]) {
                        $pageMaps[] = PageMap::create([
                            'page_id' => $id,
                            'title' => $request->map_title[$key] ?? null,
                            'description' => $request->map_description[$key] ?? null,
                            'url' => $request->map_url[$key] ?? null,
                        ]);
                    }
                }
            }

            PageImage::where('page_id', $id)->delete();

            $pageImages = [];
            if ($request->page_image) {
                foreach ($request->page_image as $key => $values) {
                    foreach ($values as $i => $value) {
                        if ($request->hasFile("page_image.$key.$i")) {
                            // Upload Image
                            $request->file("page_image.$key.$i");
                            $fileName = time().'_'.$request->file("page_image.$key.$i")->getClientOriginalName();
                            $request->file("page_image.$key.$i")->storeAs('uploads', $fileName, 'public');
                        }else{
                            $fileName = $value;
                        }

                        $pageImages[$key][$i] = PageImage::create([
                            'page_id' => $id,
                            'image' => $fileName,
                            'title' => isset($request->image_title[$key][$i]) ? $request->image_title[$key][$i] : null,
                            'description' => isset($request->image_description[$key][$i]) ? $request->image_description[$key][$i] : null,
                            'alt' => isset($request->image_alt[$key][$i]) ? $request->image_alt[$key][$i] : null,
                            'link' => isset($request->image_link[$key][$i]) ? $request->image_link[$key][$i] : null,
                        ]);
                    }
                }
            }


            if ($request->section_types) {
                PageOrder::where('page_id', $id)->delete();

                $sectionImageIds = [];
                $sectionPageIds = [];
                $sectionMapIds = [];

                foreach ($request->section_types as $key => $type) {

                    if ($type == 'image' && isset($pageImages[$key])) {
                        foreach ($pageImages[$key] as $i => $pageImage) {
                            PageOrder::create([
                                'page_id' => $id,
                                'model_id' => $pageImage->id,
                                'title' => $request->page_image_title[$key] ?? null,
                                'type' => $type,
                                'position' => $key,
                            ]);
                        }
                        $sectionImageIds[] = $pageImage->id;
                    }else if ($type == 'description' && isset($pageSection[count($sectionPageIds)]->id)) {
                        PageOrder::create([
                            'page_id' => $id,
                            'model_id' => $pageSection[count($sectionPageIds)]->id,
                            'type' => $type,
                            'position' => $key,
                        ]);
                        $sectionPageIds[] = $pageSection[count($sectionPageIds)];
                    } else if ($type == 'map' && isset($pageMaps[count($sectionMapIds)]->id)) {
                        PageOrder::create([
                            'page_id' => $id,
                            'model_id' => $pageMaps[count($sectionMapIds)]->id,
                            'type' => $type,
                            'position' => $key,
                        ]);
                        $sectionMapIds[] = $pageMaps[count($sectionMapIds)];
                    }
                }
            }

            Page::find($id)->brands()->detach();
            if ($request->has('page_brand_id')) {
                $arr = [];
                foreach ($request->page_brand_id as $key => $value) {
                    foreach (json_decode($value) as $k => $v) {
                        $arr[$k] = ['index' => $v->index];
                    }
                }

                Page::find($id)->brands()->sync($arr);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'messages' => 'Page successfully updated.',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $page = Page::find($id)->delete();

            return response()->json([
                'status' => true,
                'messages' => 'Page successfully deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function select()
    {
        try {
            $pages = Page::get()->map(function ($page) {
                return [
                    'value' => $page->id,
                    'label' => $page->title,
                ];
            });

            return response()->json([
                'status' => true,
                'pages' => $pages,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
