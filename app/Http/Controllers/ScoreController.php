<?php

namespace App\Http\Controllers;

use App\Models\CardInformation;
use App\Models\GameResult;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function calculate(Request $request, $gameId)
    {
        $attackerSelectId = $request->query('attacker_select_id');
        $card = CardInformation::where('game_id', $gameId)
            ->where('attacker_select_id', $attackerSelectId)
            ->first();

        $selectedCards = $request->query('selectedCards');
        $totalScore = 0;

        foreach ($selectedCards as $selectedCard) {
            $cardField = 'defender_card' . $selectedCard . '_score';
            $totalScore += $card->$cardField;
        }

        return response()->json(['score' => $totalScore]);
    }

    public function getScore(Request $request, $gameId)
    {
        $attackerSelectId = $request->query('attacker_select_id');
        $card = CardInformation::where('game_id', $gameId)
            ->where('attacker_select_id', $attackerSelectId)
            ->first();

        if ($card === null) {
            return response()->json(['error' => 'No matching card found'], 404);
        }

        $cardScores = [];

        for ($i = 1; $i <= 5; $i++) { // Assuming there are 5 defender cards
            $cardField = 'defender_card' . $i . '_score';
            $cardScores[$cardField] = $card->$cardField;
        }

        return response()->json($cardScores);
    }

    public function store(Request $request)
    {
        $gameResult = new GameResult;

        $gameResult->fill($request->all());
        $gameResult->save();

        return response()->json([
            'success' => true,
            'message' => 'Game result stored successfully.'
        ]);
    }
}
