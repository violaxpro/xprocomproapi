<?php

namespace App\Http\Controllers;

use HackerESQ\Settings\Facades\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        $settings = Settings::get();

        return response()->json([
            'status' => true,
            'data' => $settings,
        ]);
    }

    public function store(Request $request) {
        $data = [];

        foreach ($request->all() as $key => $value) {
            if ($value) {
                if ($request->hasFile($key)) {
                    $fileName = time().'_'.$request->$key->getClientOriginalName();
                    $request->file($key)->storeAs('uploads', $fileName, 'public');
                    $request->all()[$key] = $fileName;
                    $data[$key] = $fileName;
                }else{
                    $data[$key] = $value;
                }
            }
        }

        $settings = Settings::set($data);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
