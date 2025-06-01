<?php

namespace App\Events;

use App\Models\MultiplayerQuiz;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionBroadcasted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public MultiplayerQuiz $quiz,
        public array $question,
        public $openingAt,
        public $questionAt,
        public $memeAt
    ){}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("quiz.{$this->quiz->id}")
        ];
    }

    public function broadcastWith()
    {
        return [
            'question' => $this->question,
            'openingAt' => $this->openingAt->toDateTimeString(),
            'questionAt' => $this->questionAt->toDateTimeString(),
            'memeAt' => $this->memeAt->toDateTimeString()
        ];
    }
}