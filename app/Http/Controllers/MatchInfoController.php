<?php

namespace App\Http\Controllers;

use App\Models\MatchInfo;

use Illuminate\Http\Request;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

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

    public function export()
    {
        $csv = Writer::createFromString('');
        $csv->insertOne(['id', 'user_id', 'game_id', 'opponent_id', 'user_role', 'communication', 'created_at', 'updated_at']);

        $gameInfos = MatchInfo::all();

        foreach ($gameInfos as $gameInfo) {
            $csv->insertOne($gameInfo->toArray());
        }

        $csvStr = $csv->toString();

        return Response::make($csvStr, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="game_info.csv"',
        ]);
    }
}
