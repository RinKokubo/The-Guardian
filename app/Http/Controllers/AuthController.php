<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginWithoutPassword(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        Auth::login($user);

        if (Auth::check()) {
            // Sanctum を使って Personal Access Token を生成
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'message' => 'User logged in successfully!',
                'isLoggedIn' => true,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'User is not logged in.',
                'isLoggedIn' => false
            ], 401);
        }
    }
}
