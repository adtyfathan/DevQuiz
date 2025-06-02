<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\MultiplayerQuiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Start extends Component
{
    public $quiz;
    public $player;
    public $currentQuestion = 0;
    public $totalPoints = 0;

    public function mount($quizId)
    {
        $this->quiz = MultiplayerQuiz::findOrFail($quizId);
        $this->player = Auth::user();
        
        // Clear previous answers
        $this->clearPreviousAnswers();
    }
    
    public function handlePlayerAnswer($point, $userAnswer, $isCorrect)
    {
        $cacheKey = $this->getAnswersCacheKey();
        $answers = Cache::get($cacheKey, []);

        $answers[] = [
            'answer' => $userAnswer,
            'is_correct' => $isCorrect,
            'point' => $point,
            'time' => now()->toDateTimeString(),
            'question_number' => $this->currentQuestion
        ];

        Cache::put($cacheKey, $answers, now()->addMinutes(25));
        
        $this->totalPoints += $point;
        $this->player->update(['point' => $this->totalPoints]);
    }

    private function getAnswersCacheKey(): string
    {
        return "quiz_session:{$this->quiz->id}:user:{$this->player->id}:answers";
    }

    private function clearPreviousAnswers(): void
    {
        Cache::forget($this->getAnswersCacheKey());
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.player.start', [
            'questionDuration' => $this->quiz->question_duration
        ]);
    }
}