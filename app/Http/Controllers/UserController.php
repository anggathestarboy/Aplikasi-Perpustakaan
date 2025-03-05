<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserData(Request $request)
    {
        // Mengambil data user berdasarkan token (user yang sedang login)
        $user = $request->user(); // Menggunakan $request->user() untuk mengambil user yang terautentikasi
        return response()->json($user); // Mengembalikan data pengguna sebagai JSON
    }
}
