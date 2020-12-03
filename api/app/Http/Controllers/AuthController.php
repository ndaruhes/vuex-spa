<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|min:3',
                'password' => 'required|'
            ],
            [
                'email.required' => 'email tidak boleh kosong',
                'email.min' => 'email minimal 3 huruf',
                'password.required' => 'password tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Harap isi data dengan benar',
                'data' => $validator->errors()
            ], 400);
        } else {
            $credentials = $request->only(['email', 'password']);
            if (!$token = JWTAuth::attempt($credentials)) {
                $user = User::where('email', '=', $request->email)->first();
                if ($user == null) {
                    return response()->json(['error' => 'Akun anda belum mendaftar'], 401);
                } else {
                    return response()->json(['error' => 'Kombinasi email dan password tidak sesuai'], 401);
                }
            }

            return response()->json([
                'success' => 'Berhasil login',
                'token' => $token
            ]);
        }
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Berhasil logout'
        ]);
    }
}
