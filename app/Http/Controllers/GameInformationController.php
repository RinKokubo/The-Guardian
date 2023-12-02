<?php

namespace App\Http\Controllers;

use App\Models\GameInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

class GameInformationController extends Controller
{
    public function show($id)
    {
        $game = GameInformation::with([
            'defender_card1',
            'defender_card2',
            'defender_card3',
            'defender_card4',
            'defender_card5',
            'attacker_card1',
            'attacker_card2',
            'attacker_card3',
        ])->find($id);

        if (!$game) {
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
            return response()->json(['error' => 'Game not found'], 404);
        }

        $selected_card = $game["attacker_card{$attacker_select_id}"];

        if (!$selected_card) {
            return response()->json(['error' => 'Attacker card not found'], 404);
        }

        return response()->json($selected_card);
    }
    public function store(Request $request)
    {
        $gameInfo = GameInformation::create($request->all());
        return response()->json($gameInfo, 201);
    }

    public function export()
    {
        $csv = Writer::createFromString('');
        $csv->insertOne(['id', 'attacker_card1_id', 'attacker_card2_id', 'attacker_card3_id', 'defender_card1_id', 'defender_card2_id', 'defender_card3_id', 'defender_card4_id', 'defender_card5_id']);

        $gameInfos = GameInformation::all();

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
