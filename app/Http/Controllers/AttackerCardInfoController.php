<?php

namespace App\Http\Controllers;

use App\Models\AttackerCardInfo;
use App\Models\AttackerCard;
use App\Models\GameInformation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

class AttackerCardInfoController extends Controller
{

    public function show($card)
    {
        try {
            // 指定された名前でAttackerCardモデルを検索
            $attackerCard = AttackerCard::where('attacker_card_name', $card)->firstOrFail();

            // AttackerCardInfoモデルを検索
            $attackerCardInfo = AttackerCardInfo::where('attacker_card_id', $attackerCard->id)->firstOrFail();

            // JSON形式で情報を返す
            return response()->json($attackerCardInfo);
        } catch (ModelNotFoundException $exception) {
            // エラーメッセージを返す
            return response()->json(['message' => 'Attacker card info not found for the provided name.'], 404);
        }
    }

    public function showGame($gameId, $card)
    {
        try {
            // AttackerCardモデルを検索
            $attackerCard = AttackerCard::where('attacker_card_name', $card)->firstOrFail();

            // GameInformationModelを検索
            $gameInfo = GameInformation::findOrFail($gameId);

            // 対応するattacker_card_idを取得
            $attackerCardIds = [
                $gameInfo->attacker_card1_id,
                $gameInfo->attacker_card2_id,
                $gameInfo->attacker_card3_id,
            ];

            // 一致するカード番号を探す
            $matchedCardNumber = array_search($attackerCard->id, $attackerCardIds) + 1;

            // 一致したカード番号を返す
            return response()->json(['attackerCardNumber' => $matchedCardNumber]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Game or attacker card info not found.'], 404);
        }
    }

    public function export()
    {
        $csv = Writer::createFromString('');
        $csv->insertOne([
            'id', 'attacker_card_name', 'created_at', 'updated_at'
        ]);

        $attackerCards = AttackerCard::all();

        foreach ($attackerCards as $attackerCard) {
            $csv->insertOne($attackerCard->toArray());
        }

        $csvStr = $csv->toString();

        return Response::make($csvStr, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="attacker_card.csv"',
        ]);
    }
}
