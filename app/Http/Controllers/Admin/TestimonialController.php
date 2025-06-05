<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function index() {
        return Testimonial::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'caption' => 'required',
                // 'company' => 'required|max:255',
                // 'job_title' => 'required|max:255',
                'rating' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $testimonial = Testimonial::create([
                'name' => $request->name,
                'caption' => $request->caption,
                'company' => $request->company,
                'job_title' => $request->job_title,
                'rating' => $request->rating,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Testimonial successfully created.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        return Testimonial::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'logo' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $testimonial = Testimonial::where('id', $id)->update([
                'name' => $request->name,
                'caption' => $request->caption,
                'company' => $request->company,
                'job_title' => $request->job_title,
                'rating' => $request->rating,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Testimonial successfully updated.',
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
            $testimonial = Testimonial::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Testimonial successfully deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
