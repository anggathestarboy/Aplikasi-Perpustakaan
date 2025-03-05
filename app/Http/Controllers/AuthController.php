<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Login untuk User
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Cek user
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate token
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    // Login untuk Admin
    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Cek admin
        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate token
        $token = $admin->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    // Logout untuk User dan Admin
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}


