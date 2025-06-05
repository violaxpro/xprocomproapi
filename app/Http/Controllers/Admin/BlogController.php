<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index() {
        return Blog::searchQuery(request('search'))->with('category')->paginate(request('limit') ?? 10);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'blog_category_id' => 'required',
                'title' => 'required|max:255',
                'thumbnail' => 'required',
                'author' => 'required|max:255',
                'short_description' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $filename = null;
            if ($request->file('thumbnail')){
                $file = $request->file('thumbnail');
                $filename = time() . $file->getClientOriginalName();
                $request->file('thumbnail')->storeAs('uploads', $filename, 'public');
            }

            $blog = Blog::create([
                'blog_category_id' => $request->blog_category_id,
                'title' => $request->title,
                'thumbnail' => $filename,
                'author' => $request->author,
                'short_description' => $request->short_description,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Blog successfully created.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        return Blog::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function edit($id)
    {
        $blog = Blog::with('category')->where('id', $id)->first();

        return response()->json([
            'data' => $blog,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'blog_category_id' => 'required',
                'title' => 'required|max:255',
                'author' => 'required|max:255',
                'short_description' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $filename = null;
            if ($request->file('thumbnail')){
                $file = $request->file('thumbnail');
                $filename = time() . $file->getClientOriginalName();
                $request->file('thumbnail')->storeAs('uploads', $filename, 'public');
            }

            $blog = Blog::find($id);
            $blog->blog_category_id = $request->blog_category_id;
            $blog->title = $request->title;
            $blog->author = $request->author;
            $blog->short_description = $request->short_description;
            $blog->description = $request->description;

            if ($request->hasFile('thumbnail')) {
                $blog->thumbnail = $filename;
            }

            $blog->save();

            return response()->json([
                'status' => true,
                'message' => 'Blog successfully updated.',
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
            $blog = Blog::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Blog successfully deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
