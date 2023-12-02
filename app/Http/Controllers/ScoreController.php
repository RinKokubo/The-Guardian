<?php

namespace App\Http\Controllers;

use App\Models\CardInformation;
use App\Models\GameResult;
use Illuminate\Http\Request;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

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
        $individualScores = [];

        foreach ($selectedCards as $selectedCard) {
            $cardField = 'defender_card' . $selectedCard . '_score';
            $score = $card->$cardField;
            $totalScore += $score;
            $individualScores['card' . $selectedCard] = $score;
        }

        return response()->json(['totalScore' => $totalScore, 'individualScores' => $individualScores]);
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

    public function export()
    {
        $csv = Writer::createFromString('');
        $csv->insertOne(['id', 'attacker_name', 'defender_name', 'game_id', 'attacker_select_id', 'defender_select_1', 'defender_select_2', 'defender_select_3', 'defender_select_4', 'defender_select_5', 'attacker_score', 'defender_score']);

        $gameResults = GameResult::all();

        foreach ($gameResults as $result) {
            $csv->insertOne($result->toArray());
        }

        $csvStr = $csv->toString();

        return Response::make($csvStr, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=game_results.csv',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}
