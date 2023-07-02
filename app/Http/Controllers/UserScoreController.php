<?php

namespace App\Http\Controllers;

use App\Models\UserScore;
use Illuminate\Http\Request;

class UserScoreController extends Controller
{
    public function store(Request $request)
    {
        $userScore = UserScore::create($request->all());
        return response()->json($userScore, 201);
    }
}
