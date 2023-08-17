<?php

namespace App\Http\Controllers;

use App\Models\AttackerCard;
use App\Models\CardInformation;
use App\Models\Notice;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function show($id)
    {
        $notice = Notice::find($id);

        if (!$notice) {
            return response()->json(['error' => 'Notice not found'], 404);
        }

        return response()->json($notice);
    }

    public function store(Request $request)
    {
        $attackerCard = AttackerCard::create($request->all());
        return response()->json($attackerCard, 201);
    }

    public function export()
    {
        $csv = Writer::createFromString('');
        $csv->insertOne([
            'id',
            'game_id',
            'attacker_select_id',
            'defender_card1_score',
            'defender_card2_score',
            'defender_card3_score',
            'defender_card4_score',
            'defender_card5_score',
        ]);

        $cardInfos = CardInformation::all();

        foreach ($cardInfos as $cardInfo) {
            $csv->insertOne($cardInfo->toArray());
        }

        $csvStr = $csv->toString();

        return Response::make($csvStr, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="card_information.csv"',
        ]);
    }
}
