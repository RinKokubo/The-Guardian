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
        return response()->json($users);
    }

    public function showUserName($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        return response()->json(['username' => $user->name]);
    }

    public function updateWaitingStatus(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->is_waiting = $request->input('is_waiting', false);
        $user->save();

        return response()->json(['message' => 'Waiting status updated']);
    }

    public function getWaitingStatus($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json(['is_waiting' => $user->is_waiting]);
    }
}
