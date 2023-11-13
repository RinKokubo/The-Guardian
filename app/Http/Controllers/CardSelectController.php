<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\AttackerCardSelected;
use App\Events\DefenderCardSelected;
use App\Events\DefenderTransit;
use App\Events\AttackerTransit;

class CardSelectController extends Controller
{
    public function attackerSelectCard(Request $request)
    {
        $userId = $request->input('userId');
        $cardName = $request->input('cardName');
        $opponentId = $request->input('opponentId');

        event(new AttackerCardSelected($userId, $opponentId, $cardName));

        return response()->json(['message' => 'カード情報を送信しました']);
    }

    public function defenderSelectCard(Request $request)
    {
        $userId = $request->input('user_id');
        $opponentId = $request->input('opponent_id');
        $selectedCards = $request->input('selected_cards');

        event(new DefenderCardSelected($opponentId, $selectedCards));

        return response()->json(['message' => 'Selected cards information sent successfully.']);
    }

    public function defenderTransit(Request $request)
    {
        $transit = $request->input('transit');
        $opponentId = $request->input('opponentId');

        event(new DefenderTransit($transit, $opponentId));

        return response()->json(['message' => 'Transit information sent successfully.']);
    }
}
