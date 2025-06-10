<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\CompletedQuiz;
use App\Models\MultiplayerQuiz;
use App\Models\SingleplayerQuiz;

class History extends Component
{
    public $userId;
    public $completedQuizzes = [];
    public $hostedQuizzes = [];

    public function mount()
    {
        $this->userId = Auth::user()->id;

        $this->getHistoryData();
    }

    public function getHistoryData()
    {
        $this->completedQuizzes = CompletedQuiz::with([
            'multiplayerPlayer',
            'singleplayerQuiz.user',
            'multiplayerQuiz'
        ])->where('user_id', $this->userId)->get();

        $this->hostedQuizzes = MultiplayerQuiz::with('completedQuiz')
            ->where('host_id', $this->userId)
            ->where('status', 'finished')
            ->get();
    }

    public function redirectPlayerSummary($completedQuizId)
    {
        $this->redirect(route('quiz.multiplayer.player.summary', ['completedQuizId' => $completedQuizId]), true);
    }

    public function redirectHostSummary($multiplayerQuizId)
    {
        $this->redirect(route('quiz.multiplayer.host.summary', ['multiplayerQuizId' => $multiplayerQuizId]), true);
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.history');
    }
}