<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\MultiplayerQuiz;
use App\Models\MultiplayerPlayer;

class PlayerLeaveLobby implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lobbyCode;
    public $playerData;
    
    public function __construct(MultiplayerQuiz $quiz, MultiplayerPlayer $player)
    {
        $this->lobbyCode = $quiz->lobby_code;
        $this->playerData = [
            'id' => $player->id,
            'player_id' => $player->player_id,
            'username' => $player->username
        ];
    }
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('quiz-lobby.' . $this->lobbyCode),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'player' => $this->playerData,
            'lobby_code' => $this->lobbyCode,
        ];
    }
}