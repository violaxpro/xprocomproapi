<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $searchable = ['title', 'description', 'short_description', 'author'];
        $blogs = Blog::with('category')->orderBy('id', 'DESC')
        ->where(function ($query) use ($searchable) {
            foreach ($searchable as $column) {
                $query->orWhere($column, 'like', "%". request('search') ."%");
            }
            if (request('category')) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', request('category'));
                });
            }
        });
        $blogs = $blogs->paginate(10);
        $latest = Blog::orderBy('id', 'DESC')->limit(3)->get();
        $categories = BlogCategory::orderBy('id', 'DESC')->get();

        return response()->json([
            'status' => true,
            'data' => $blogs,
            'latest' => $latest,
            'categories' => $categories,
        ]);
    }

    public function show($slug)
    {
        $latest = Blog::orderBy('id', 'DESC')->limit(3)->get();
        $blog = Blog::searchQuery(request('search'))->with('category')->where('slug', $slug)->first();
        $categories = BlogCategory::orderBy('id', 'DESC')->get();

        return response()->json([
            'data' => $blog,
            'latest' => $latest,
            'categories' => $categories,
        ]);
    }
}
