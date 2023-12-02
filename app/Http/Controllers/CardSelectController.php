<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\AttackerCardSelected;
use App\Events\DefenderCardSelected;
use App\Events\DefenderTransit;

class CardSelectController extends Controller
{
    public function attackerSelectCard(Request $request)
    {
        $userId = $request->input('userId');
        $cardName = $request->input('cardName');
        $opponentId = $request->input('opponentId');

        // アタッカーが選択したカードをイベントを使ってディフェンダーに通知
        event(new AttackerCardSelected($userId, $opponentId, $cardName));

        return response()->json(['message' => 'カード情報を送信しました']);
    }

    public function defenderSelectCard(Request $request)
    {
        $userId = $request->input('user_id');
        $opponentId = $request->input('opponent_id');
        $selectedCards = $request->input('selected_cards');

        // ディフェンダーが選択したカードをイベントを使ってアタッカーに通知
        event(new DefenderCardSelected($opponentId, $selectedCards));

        return response()->json(['message' => 'Selected cards information sent successfully.']);
    }

    public function defenderTransit(Request $request)
    {
        $transit = $request->input('transit');
        $opponentId = $request->input('opponentId');

        // ディフェンダーの画面遷移をイベントを使ってアタッカーに通知
        event(new DefenderTransit($transit, $opponentId));

        return response()->json(['message' => 'Transit information sent successfully.']);
    }
}
