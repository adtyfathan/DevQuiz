<?php

namespace App\Jobs;

use App\Events\StandingsUpdated;
use App\Models\MultiplayerQuiz;
use App\Models\MultiplayerPlayer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Expr\AssignOp\Mul;
use App\Events\QuizEnded;
use App\Models\CompletedQuiz;
use App\Models\PlayerAnswer;

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
        if ($this->isLast) {
            MultiplayerQuiz::find($this->quiz->id)->update([
                'status' => 'finished',
                'finished_at' => now()
            ]);

            MultiplayerPlayer::where('multiplayer_quiz_id', $this->quiz->id)->update([
                'status' => 'finished', 
                'finished_at' => now()
            ]);

            broadcast(new QuizEnded($this->quiz));
        }

        broadcast(new StandingsUpdated(
            $this->quiz, 
            $this->players,
            $this->standingsAt, 
            isLast: $this->isLast, 
            category: $this->category, 
            difficulty: $this->difficulty
        ));
    }
}