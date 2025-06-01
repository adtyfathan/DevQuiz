<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\MultiplayerQuiz;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class Start extends Component
{
    public $quiz;

    public $player;
    
    public function mount($quizId)
    {
        $this->quiz = MultiplayerQuiz::find($quizId);

        $this->player = Auth::user();
    }
    
    public function handlePlayerAnswer($point, $userAnswer, $isCorrect)
    {
        $cacheKey = "quiz_session:{$this->quiz->id}:user:{$this->player->id}:answers";
        $answers = Cache::get($cacheKey, []);

        $answers[] = [
            'answer' => $userAnswer,
            'is_correct' => $isCorrect,
            'point' => $point,
            'time' => now()->toDateTimeString()
        ];

        Cache::put($cacheKey, $answers, now()->addMinutes(25));

        $newPoint = $this->player->point + $point;

        $this->player->update([
            'point' => $newPoint
        ]);
    }
    
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.player.start');
    }
}