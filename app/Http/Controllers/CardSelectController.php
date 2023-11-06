<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\AttackerCardSelected;

class CardSelectController extends Controller
{
    public function attackerSelectCard(Request $request)
    {
        $userId = $request->user_id;
        $card = $request->input('card');
        $opponentId = $request->input('opponentId');

        // 必要に応じてバリデーションを行う
        // $request->validate([
        //     'card' => 'required',
        //     'opponentId' => 'required|exists:users,id'
        // ]);

        // イベントをトリガーし、カード情報とopponentIdを送信
        event(new AttackerCardSelected($userId, $opponentId, $card));

        return response()->json(['message' => 'カード情報を送信しました']);
    }
}
