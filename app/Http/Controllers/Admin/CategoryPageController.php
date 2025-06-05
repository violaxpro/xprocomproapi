<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryPage;
use App\Models\CategoryPageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryPageController extends Controller
{
    public function index() {
        return CategoryPage::with('brands')->paginate(request('limit') ?? 10);
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

            $category = CategoryPage::updateOrCreate([
                'category_id' => $request->category_id,
            ], [
                'title' => $request->title,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'description' => $request->description,
                'brand_title' => $request->brand_title,
                'show_contact_form' => $request->show_contact_form,
            ]);

            CategoryPageSection::where('category_page_id', $category->id)->delete();

            if ($request->section_title && $request->section_description) {
                foreach ($request->section_title as $key => $value) {
                    if ($request->section_title[$key] && $request->section_title[$key] != '') {
                        CategoryPageSection::create([
                            'category_page_id' => $category->id,
                            'title' => $request->section_title[$key] ?? '',
                            'description' => $request->section_description[$key] ?? '',
                        ]);
                    }
                }
            }

            if ($request->has('category_page_brand_id')) {
                $arr = [];
                foreach ($request->category_page_brand_id as $key => $value) {
                    foreach ($value as $k => $v) {
                        $arr[$k] = ['index' => $v['index']];
                    }
                }

                CategoryPage::find($category->id)->brands()->detach();
                CategoryPage::find($category->id)->brands()->sync($arr);
            }

            return response()->json([
                'status' => true,
                'messages' => 'Category successfully created.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        try {
            $data = CategoryPage::with('brands', 'sections')->where('category_id', $id)->first();
            $category = Category::where('id', $id)->first();
            $brands = Brand::get()->map(function ($brand) {
                return [
                    'value' => $brand->id,
                    'label' => $brand->name,
                ];
            });

            return response()->json([
                'status' => true,
                'data' => $data,
                'category' => $category,
                'brands' => $brands,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
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

            $category = CategoryPage::where('id', $id)->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'description' => $request->description,
                'brand_title' => $request->brand_title,
                'show_contact_form' => $request->show_contact_form,
            ]);

            CategoryPageSection::where('category_page_id', $id)->delete();

            foreach ($request->section_title as $key => $value) {
                if ($request->section_title[$key] && $request->section_title[$key] != '') {
                    CategoryPageSection::create([
                        'category_page_id' => $id,
                        'title' => $request->section_title[$key] ?? '',
                        'description' => $request->section_description[$key] ?? '',
                    ]);
                }
            }

            if ($request->has('category_page_brand_id')) {
                $arr = [];
                foreach ($request->category_page_brand_id as $key => $value) {
                    foreach ($value as $k => $v) {
                        $arr[$k] = ['index' => $v['index']];
                    }
                }

                CategoryPage::find($id)->brands()->detach();
                CategoryPage::find($id)->brands()->sync($arr);
            }

            return response()->json([
                'status' => true,
                'messages' => 'Category successfully updated.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = CategoryPage::find($id)->delete();

            return response()->json([
                'status' => true,
                'messages' => 'Category successfully deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
