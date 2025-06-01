<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\MultiplayerQuiz;

class Start extends Component
{
    public $quiz;
    
    public function mount($quizId)
    {
        $this->quiz = MultiplayerQuiz::find($quizId);
    }
    
    public function handlePlayerAnswer($point, $userAnswer, $isCorrect)
    {
        
    }
    
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.player.start');
    }
}