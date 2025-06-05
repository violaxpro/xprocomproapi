<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        return Project::searchQuery(request('search'))->with('detail', 'images')->paginate(request('limit') ?? 10);
    }

    public function show($slug) {
        return Project::searchQuery(request('search'))->with('detail', 'images')->where('slug', $slug)->first();
    }
}
