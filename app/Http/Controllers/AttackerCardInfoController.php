<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttackerCardInfo;
use App\Models\AttackerCard;
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
}
