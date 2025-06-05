<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqCategoryController extends Controller
{
    public function index() {
        return FaqCategory::searchQuery(request('search'))->orderBy('id', 'DESC')->paginate(request('limit') ?? 10);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $category = FaqCategory::create([
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
        return FaqCategory::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $category = FaqCategory::where('id', $id)->update([
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
            $category = FaqCategory::find($id)->delete();

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

    public function select()
    {
        try {
            $categories = FaqCategory::get()->map(function ($categories) {
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
