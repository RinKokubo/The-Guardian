<?php

namespace App\Http\Controllers;

use App\Models\UserScore;
use Illuminate\Http\Request;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

class UserScoreController extends Controller
{
    public function store(Request $request)
    {
        $userScore = UserScore::create($request->all());
        return response()->json($userScore, 201);
    }

    public function export()
    {
        $csv = Writer::createFromString('');
        $csv->insertOne(['id', 'game_id', 'attacker_select_id', 'user_name', 'user_card1_score', 'user_card2_score', 'user_card3_score', 'user_card4_score', 'user_card5_score', 'created_at', 'updated_at']);

        $userScores = UserScore::all();

        foreach ($userScores as $userScore) {
            $csv->insertOne($userScore->toArray());
        }

        $csvStr = $csv->toString();

        return Response::make($csvStr, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="user_scores.csv"',
        ]);
    }
}
