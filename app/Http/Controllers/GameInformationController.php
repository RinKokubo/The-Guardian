<?php

namespace App\Http\Controllers;

use App\Models\GameInformation;
use Illuminate\Http\Request;

class GameInformationController extends Controller
{
    public function show($id)
    {
        $game = GameInformation::with([
            'attacker_card1_id',
            'attacker_card2_id',
            'attacker_card3_id',
            'defender_card1_id',
            'defender_card2_id',
            'defender_card3_id',
            'defender_card4_id',
            'defender_card5_id',
        ])->find($id);

        return response()->json($game);
    }
}
