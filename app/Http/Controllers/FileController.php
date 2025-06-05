<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadImage(Request $request) {
        if($request->file('image')){
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $request->file('image')->storeAs('uploads', $filename, 'public');

            return response()->json([
                'filename' => $filename,
            ]);
        }
    }
}
