<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $userId = $request->sender;
        $opponentId = $request->receiver;
        $messageContent = $request->message_content;

        // データベースに保存
        $message = Message::create([
            'game_id' => $request->game_id,
            'sender' => $userId,
            'receiver' => $opponentId,
            'message_content' => $messageContent,
            'user_name' => $request->user_name,
        ]);

        broadcast(new MessageSent($userId, $opponentId, $messageContent))->toOthers();

        return response()->json(['message' => 'メッセージを送信しました']);
    }
}
