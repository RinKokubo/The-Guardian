<?php

namespace App\Http\Controllers;

use App\Models\GameInformation;
use Illuminate\Support\Facades\DB;

class GameInformationController extends Controller
{
    public function show($id)
    {
        $game = GameInformation::with([
            'defender_card1',
            'defender_card2',
            'defender_card3',
            'defender_card4',
            'defender_card5'
        ])->find($id);

        if (!$game) {
            // If the game was not found, return a 404 error.
            return response()->json(['error' => 'Game not found'], 404);
        }

        return response()->json($game);
    }
}
