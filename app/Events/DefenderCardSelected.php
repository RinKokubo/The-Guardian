<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DefenderCardSelected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $selectedCards;

    public function __construct($userId, $selectedCards)
    {
        $this->userId = $userId;
        $this->selectedCards = $selectedCards;

        \Illuminate\Support\Facades\Log::info('DefenderCardSelected Event fired.', [
            'userId' => $userId,
            'selectedCards' => $selectedCards,
        ]);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'defenderCards.selected';
    }
}
