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

        // Check if the user is actually logged in
        if (Auth::check()) {
            return response()->json([
                'message' => 'User logged in successfully!',
                'isLoggedIn' => true
            ]);
        } else {
            return response()->json([
                'message' => 'User is not logged in.',
                'isLoggedIn' => false
            ], 401);
        }
    }
}
