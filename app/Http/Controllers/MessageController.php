<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message_content' => 'required',
            'gameId' => 'required',
            'receiver' => 'required|exists:users,id',
            'sender' => 'required|exists:users,id'
        ]);

        $message = new Message();
        $message->game_id = $request->gameId;
        $message->sender = $request->sender;
        $message->receiver = $request->receiver;
        $message->message_content = $request->message_content;
        $message->user_name = $request->username;
        $message->save();

        broadcast(new MessageSent($request->sender, $request->receiver, $message))->toOthers();

        return response()->json($message, 201);
    }
}
