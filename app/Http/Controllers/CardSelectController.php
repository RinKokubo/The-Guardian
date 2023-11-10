<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\AttackerCardSelected;
use App\Events\DefenderCardSelected;

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

        // カードが選択されたことを対戦相手に通知
        event(new DefenderCardSelected($opponentId, $selectedCards));

        \Illuminate\Support\Facades\Log::info('CardSelectController fired.', [
            'opponentId' => $opponentId,
            'card' => $selectedCards
        ]);

        return response()->json(['message' => 'Selected cards information sent successfully.']);
    }
}
