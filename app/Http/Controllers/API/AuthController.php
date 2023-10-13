<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3'
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['message' => 'Account has been created successfully'], 200);
    }

    public function login(Request $request) {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password) ) {
            return response()->json([
                'message'=>'Password atau Email salah!',
            ], 401);
        }

        $token = $user->createToken('token_name')->plainTextToken;

        return response()->json([
                'message'=>'Success!',
                'data'=> [
                    'user'=>$user,
                    'token' => $token
                ]
         ], 200);
    }

    public function logout(Request $request) {


       $request->user()->currentAccessToken()->delete();

       return response()->json([
                'message'=>'Berhasil logout!'
         ], 200);
    }
}
