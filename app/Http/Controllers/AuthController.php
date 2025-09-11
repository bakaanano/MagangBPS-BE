<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak ditemukan'
            ], 404);
        }
        if ($user->password !== $request->password) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password salah'
            ], 401);
        }
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'status'      => 'success',
            'message'     => 'Login berhasil',
            'access_token'=> $token,
            'token_type'  => 'Bearer',
            'user'        => [
                'id'    => $user->id ?? null,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}