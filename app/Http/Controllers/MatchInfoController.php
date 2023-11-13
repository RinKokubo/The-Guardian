<?php

namespace App\Http\Controllers;

use App\Models\MatchInfo;

use Illuminate\Http\Request;

class MatchInfoController extends Controller
{
    public function getMatchInfo(Request $request)
    {
        $user_id = $request->input('user_id');
        $game_id = $request->input('game_id');

        $matchInfo = MatchInfo::where('user_id', $user_id)
            ->where('game_id', $game_id)
            ->first();

        if ($matchInfo) {
            return response()->json($matchInfo);
        }

        return response()->json(['error' => 'MatchInfo not found'], 404);
    }
}
