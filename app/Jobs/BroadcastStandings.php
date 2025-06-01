<?php

namespace App\Jobs;

use App\Events\StandingsUpdated;
use App\Models\MultiplayerQuiz;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BroadcastStandings implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public MultiplayerQuiz $quiz,
        public $players,
        public $standingsAt,
        public $isLast,
        public $category,
        public $difficulty
    ){}

    public function handle(): void
    {
        broadcast(new StandingsUpdated($this->quiz, $this->players, $this->standingsAt, isLast: $this->isLast, category: $this->category, difficulty: $this->difficulty));
    }
}