<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $opponentId;
    public $messageContent;

    public function __construct($userId, $opponentId, $messageContent)
    {
        $this->userId = $userId;
        $this->opponentId = $opponentId;
        $this->messageContent = $messageContent;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->opponentId);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}
