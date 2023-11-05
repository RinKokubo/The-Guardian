<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginWithoutPassword(Request $request)
    {
        // ここにユーザーを認証するロジックを実装します。
        // 例としてユーザーIDを使用して直接ログインする例を示します。

        $user = User::findOrFail($request->user_id);

        Auth::login($user);

        return response()->json([
            'message' => 'User logged in successfully!'
        ]);
    }
}
