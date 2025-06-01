<?php

namespace App\Events;

use App\Models\MultiplayerQuiz;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StandingsUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public MultiplayerQuiz $quiz,
        public $players,
        public $standingsAt,
        public $isLast,
        public $category,
        public $difficulty 
    ){}
    
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("quiz.{$this->quiz->id}")
        ];
    }

    public function broadcastWith()
    {
        return [
            'players' => $this->players,
            'standingsAt' => $this->standingsAt->toDateTimeString(),
            'isLast' => $this->isLast,
            'category' => $this->category,
            'difficulty' => $this->difficulty
        ];
    }
}