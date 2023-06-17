<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:users|max:255',
            'password' => 'required|min:8',
        ]);

        $user = new User;
        $user->name = $validatedData['name'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return redirect()->route('home');
    }

    public function index()
    {
        $users = User::where('is_logged_in', true)->get(); // is_logged_inがtrueのユーザーだけを取得
        return response()->json($users); // ユーザ一覧をJSON形式で返す
    }
}
