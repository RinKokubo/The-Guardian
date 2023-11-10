<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AttackerCardSelected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $card;
    public $opponentId;
    public $userId;

    public function __construct($userId, $opponentId, $card)
    {
        $this->userId = $userId;
        $this->card = $card;
        $this->opponentId = $opponentId;

        \Illuminate\Support\Facades\Log::info('AttackerCardSelected Event fired.', [
            'userId' => $userId,
            'opponentId' => $opponentId,
            'card' => $card
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->opponentId);
    }

    public function broadcastAs()
    {
        return 'card.selected';
    }
}
