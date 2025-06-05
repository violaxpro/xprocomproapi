<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    public function index() {
        $categories = BlogCategory::searchQuery(request('search'));
        if (request('type') == 'select') {
            $categories = $categories->get()->map(function ($value) {
                return [
                    'value' => $value->id,
                    'label' => $value->name,
                ];
            });
        }else{
            $categories = $categories->paginate(request('limit') ?? 10);
        }
        return $categories;
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

            $category = BlogCategory::create([
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Category successfully created.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        return BlogCategory::searchQuery(request('search'))->paginate(request('limit') ?? 10);
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

            $category = BlogCategory::where('id', $id)->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Category successfully updated.',
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
            $category = BlogCategory::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Category successfully deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
