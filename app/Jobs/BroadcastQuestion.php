<?php

namespace App\Jobs;

use App\Models\MultiplayerQuiz;
use App\Events\QuestionBroadcasted;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BroadcastQuestion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public MultiplayerQuiz $quiz,
        public array $question,
        public $openingAt,
        public $questionAt,
        public $memeAt,
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        broadcast(new QuestionBroadcasted($this->quiz, $this->question, $this->openingAt, $this->questionAt, memeAt: $this->memeAt));
    }
}