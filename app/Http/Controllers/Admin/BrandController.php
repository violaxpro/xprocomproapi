<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index() {
        return Brand::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function store(Request $request)
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

            $filename = null;
            if ($request->file('logo')){
                $file = $request->file('logo');
                $filename = time() . $file->getClientOriginalName();
                $request->file('logo')->storeAs('uploads', $filename, 'public');
            }

            $brand = Brand::create([
                'name' => $request->name,
                'website' => $request->website,
                'logo' => $request->hasFile('logo') ? $filename : null,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Brand successfully created.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        return Brand::searchQuery(request('search'))->paginate(request('limit') ?? 10);
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

            $filename = null;
            if ($request->file('logo')){
                $file = $request->file('logo');
                $filename = time() . $file->getClientOriginalName();
                $request->file('logo')->storeAs('uploads', $filename, 'public');
            }

            $brand = Brand::find($id);
            $brand->name = $request->name;
            $brand->website = $request->website;

            if ($request->hasFile('logo')) {
                $brand->logo = $filename;
            }

            $brand->save();

            return response()->json([
                'status' => true,
                'message' => 'Brand successfully updated.',
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
            $brand = Brand::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Brand successfully deleted.',
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
            $brands = Brand::get()->map(function ($brand) {
                return [
                    'value' => $brand->id,
                    'label' => $brand->name,
                ];
            });

            return response()->json([
                'status' => true,
                'brands' => $brands,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
