<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index() {
        return Faq::with('category')->searchQuery(request('search'))->orderBy('id', 'DESC')
            ->paginate(request('limit') ?? 10);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'faq_category_id' => 'required',
                'question' => 'required',
                'answer' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $faq = Faq::create([
                'faq_category_id' => $request->faq_category_id,
                'question' => $request->question,
                'answer' => $request->answer,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Faq successfully created.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        return Faq::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'faq_category_id' => 'required',
                'question' => 'required',
                'answer' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $faq = Faq::where('id', $id)->update([
                'faq_category_id' => $request->faq_category_id,
                'question' => $request->question,
                'answer' => $request->answer,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Faq successfully updated.',
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
            $faq = Faq::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Faq successfully deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
