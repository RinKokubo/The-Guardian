<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // ユーザーが存在するかどうか確認
        $user = User::findOrFail($request->user_id);

        // リクエストされたパスワードがユーザーのパスワードと一致するか確認
        if ($request->password == $user->password) {
            Auth::login($user);

            if (Auth::check()) {
                // Sanctumを使ってPersonal Access Tokenを生成
                $token = $user->createToken('Personal Access Token')->plainTextToken;

                return response()->json([
                    'message' => 'User logged in successfully!',
                    'isLoggedIn' => true,
                    'token' => $token
                ]);
            }
        } else {
            return response()->json([
                'message' => 'パスワードが違います。',
                'isLoggedIn' => false
            ], 401);
        }
    }
}
