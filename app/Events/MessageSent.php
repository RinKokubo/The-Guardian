<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    public $message;
    public $sender_id;
    public $receiver_id;

    public function __construct($sender_id, $receiver_id, $message)
    {
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('game.' . $this->message->game_id . '.user.' . $this->sender_id),
            new PrivateChannel('game.' . $this->message->game_id . '.user.' . $this->receiver_id)
        ];
    }
}
