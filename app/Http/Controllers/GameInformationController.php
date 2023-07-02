<?php

namespace App\Http\Controllers;

use App\Models\GameInformation;
use Illuminate\Http\Request;
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

    public function attackerShow($id, Request $request)
    {
        $attacker_select_id = $request->query('attacker_select_id');
        $game = GameInformation::with([
            'attacker_card1',
            'attacker_card2',
            'attacker_card3',
        ])->find($id);

        if (!$game) {
            // If the game was not found, return a 404 error.
            return response()->json(['error' => 'Game not found'], 404);
        }

        // Get the selected attacker card
        $selected_card = $game["attacker_card{$attacker_select_id}"];

        if (!$selected_card) {
            // If the attacker card was not found, return a 404 error.
            return response()->json(['error' => 'Attacker card not found'], 404);
        }

        return response()->json($selected_card);
    }
}
