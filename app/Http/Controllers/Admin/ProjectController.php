<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index() {
        return Project::searchQuery(request('search'))->with('detail', 'images')->paginate(request('limit') ?? 10);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'url' => 'required',
                'company' => 'required|max:255',
                'thumbnail' => 'required',
                'short_description' => 'required|max:255',
                'images' => 'required',
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

            $project = Project::create([
                'name' => $request->name,
                'url' => $request->url,
                'company' => $request->company,
                'thumbnail' => $filename,
                'short_description' => $request->short_description,
            ]);

            $detail = ProjectDetail::create([
                'project_id' => $project->id,
                'is_has_feature' => !!$request->is_has_feature,
                'feature_title' => $request->feature_title,
                'features' => $request->features,
                'is_has_service' => !!$request->is_has_service,
                'service_title' => $request->service_title,
                'services' => $request->services,
                'description' => $request->description,
            ]);

            foreach ($request->images as $key => $image) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'path' => $image,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Project successfully created.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        return Project::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'url' => 'required',
                'company' => 'required|max:255',
                'thumbnail' => 'required',
                'short_description' => 'required|max:255',
                'images' => 'required',
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

            $project = Project::find($id);
            $project->name = $request->name;
            $project->url = $request->url;
            $project->company = $request->company;
            $project->short_description = $request->short_description;

            if ($request->hasFile('thumbnail')) {
                $project->thumbnail = $filename;
            }

            $project->save();

            $detail = ProjectDetail::where('project_id', $id)->first();
            $detail->is_has_feature = !!$request->is_has_feature;
            $detail->feature_title = $request->feature_title;
            $detail->is_has_service = !!$request->is_has_service;
            $detail->service_title = $request->service_title;
            $detail->description = $request->description;

            // Feature to array
            $features = [];
            for ($i=1; $i <= 4; $i++) {
                $features[] = [
                    'icon' => $request->get("features_{$i}_icon"),
                    'title' => $request->get("features_{$i}_title"),
                    'description' => $request->get("features_{$i}_description"),
                ];
            }
            $detail->features = json_encode($features);

            // Service to array
            $services = [];
            for ($i=1; $i <= 4; $i++) {
                $filename = null;
                if ($request->file("services_{$i}_image")){
                    $file = $request->file("services_{$i}_image");
                    $filename = time() . $file->getClientOriginalName();
                    $request->file("services_{$i}_image")->storeAs('uploads', $filename, 'public');
                }

                $services[] = [
                    'image' => $filename,
                    'title' => $request->get("services_{$i}_title"),
                    'description' => $request->get("services_{$i}_description"),
                ];
            }
            $detail->services = json_encode($services);

            $detail->save();

            foreach ($request->images as $key => $image) {
                ProjectImage::updateOrCreate([
                    'project_id' => $id,
                    'path' => $image,
                ], [
                    'project_id' => $id,
                    'path' => $image,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Project successfully updated.',
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
            $project = Project::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Project successfully deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
