<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        return User::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User successfully created.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show($id) {
        return User::searchQuery(request('search'))->paginate(request('limit') ?? 10);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag(),
                ], 400);
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User successfully updated.',
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
            $user = User::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'User successfully deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
