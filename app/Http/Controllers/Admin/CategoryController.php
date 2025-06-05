<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        return Category::searchQuery(request('search'))->whereNull('parent_id')->orderBy('position', 'ASC')->orderBy('created_at', 'DESC')->paginate(request('limit') ?? 10);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $filename = null;
            if ($request->file('image')){
                $file = $request->file('image');
                $filename = time() . $file->getClientOriginalName();
                $request->file('image')->storeAs('uploads', $filename, 'public');
            }

            $category = Category::create([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'is_best' => intval($request->is_best),
                'position' => intval($request->position),
                'image' => $filename,
                'status' => intval($request->status),
            ]);

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
        return Category::searchQuery(request('search'))->where('parent_id', $id)->orderBy('position', 'ASC')->orderBy('created_at', 'DESC')->paginate(request('limit') ?? 10);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $filename = null;
            if ($request->file('image')){
                $file = $request->file('image');
                $filename = time() . $file->getClientOriginalName();
                $request->file('image')->storeAs('uploads', $filename, 'public');
            }

            $category = Category::find($id);
            $category->name = $request->name;
            $category->is_best = intval($request->is_best);
            $category->position = intval($request->position);
            $category->status = intval($request->status);

            if ($request->hasFile('image')) {
                $category->image = $filename;
            }

            if ($request->slug) {
                $category->slug = $request->slug;
            }

            $category->save();

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
            $category = Category::find($id)->delete();

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

    public function select()
    {
        try {
            $categories = Category::select('*');
            $excludeCategoryIds = Page::with(['category' => function ($q) {
                $q->doesnthave('child');
            }])->get()->filter(function ($value) {
                if (isset($value->category) && $value->category->parent_id) {
                    return true;
                }
            })->pluck('category_id');

            if (request()->has('parent_id')) {
                $categories = $categories->where('parent_id', request()->get('parent_id'));
            }else{
                $categories = $categories->whereNull('parent_id');
            }

            $categories = $categories->whereNotIn('id', $excludeCategoryIds)->get()->map(function ($categories) {
                return [
                    'value' => $categories->id,
                    'label' => $categories->name,
                ];
            });

            return response()->json([
                'status' => true,
                'categories' => $categories,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
