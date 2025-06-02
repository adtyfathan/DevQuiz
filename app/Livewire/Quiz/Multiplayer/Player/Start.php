<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\MultiplayerQuiz;
use App\Models\MultiplayerPlayer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Start extends Component
{
    public $quiz;
    public $player;
    public $currentQuestion = 0;
    public $totalPoints = 0;
    public $playerQuiz;

    public function mount($quizId)
    {
        $this->quiz = MultiplayerQuiz::findOrFail($quizId);
        $this->player = Auth::user();
        $this->playerQuiz = MultiplayerPlayer::where('multiplayer_quiz_id', $this->quiz->id)
            ->where('player_id', $this->player->id)
            ->first();
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

        $this->playerQuiz->update([
            'point' => $this->totalPoints
        ]);

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

    public function endQuiz()
    {
        $savedAnswers = [];
        $falseAnswer = 0;
        $score = 0;
        
        $cacheKey = $this->getAnswersCacheKey();
        $answers = Cache::get($cacheKey, []);
        
        foreach ($answers as $answer) {
            array_push($savedAnswers, $answer['answer']);
            if (!$answer['is_correct']) {
                $falseAnswer++;
            } else {
                $score += $answer['point'];
            }
        };

        
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.player.start', [
            'questionDuration' => $this->quiz->question_duration
        ]);
    }
}