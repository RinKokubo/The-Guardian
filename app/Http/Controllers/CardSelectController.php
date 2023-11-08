<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\AttackerCardSelected;

class CardSelectController extends Controller
{
    public function attackerSelectCard(Request $request)
    {
        $userId = $request->input('userId'); // $request->user_idから$request->input('userId')に変更
        $cardName = $request->input('cardName'); // $request->input('card')から$request->input('cardName')に変更
        $opponentId = $request->input('opponentId');

        event(new AttackerCardSelected($userId, $opponentId, $cardName));
        return response()->json(['message' => 'カード情報を送信しました']);
    }
}
