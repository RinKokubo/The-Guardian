<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttackerCardInfo;
use App\Models\AttackerCard;
use App\Models\GameInformation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AttackerCardInfoController extends Controller
{

    public function show($card)
    {
        try {
            // 指定された名前でAttackerCardモデルを検索する
            $attackerCard = AttackerCard::where('attacker_card_name', $card)->firstOrFail();

            // AttackerCardInfoモデルを検索する
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
}
