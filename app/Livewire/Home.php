<?php

namespace App\Livewire;

use App\Models\MultiplayerPlayer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\MultiplayerQuiz;

class Home extends Component
{
    public $userId;
    public $hostedQuiz;
    public $joinedQuiz;
    public $inProgressQuiz;

    public function mount()
    {
        $user = Auth::user();

        $this->userId = $user->id;

        $this->getHostedQuiz();

        $this->getJoinedQuiz();
        
        $this->getInProgressQuiz();
    }

    public function getHostedQuiz()
    {
        $this->hostedQuiz = MultiplayerQuiz::where('host_id', $this->userId)
            ->where('status', 'waiting')
            ->first();
    }

    public function getHostedQuizUrl()
    {
        if ($this->hostedQuiz) {
            return route('quiz.multiplayer.host.lobby', ['lobbyCode' => $this->hostedQuiz->lobby_code]);
        }
        return null;
    }
    
    
    public function getJoinedQuiz()
    {
        $playerQuiz = MultiplayerPlayer::with('multiplayerQuiz')
            ->where('player_id', $this->userId)
            ->where('status', 'waiting')
            ->first();
        
        if ($playerQuiz && $playerQuiz->multiplayerQuiz && $playerQuiz->multiplayerQuiz->status === 'waiting') {
            $this->joinedQuiz = $playerQuiz->multiplayerQuiz;
        } else {
            $this->joinedQuiz = null;
        }
    }

    public function getRejoinQuizUrl()
    {  
        if ($this->joinedQuiz && $this->joinedQuiz->status === 'waiting') {
            return route('quiz.multiplayer.player.lobby', ['lobbyCode' => $this->joinedQuiz->lobby_code]);
        }
        return null;
    }

    public function getInProgressQuiz()
    {
        $inProgressQuiz = MultiplayerPlayer::with('multiplayerQuiz')
            ->where('player_id', $this->userId)
            ->where('status', 'in_progress')
            ->first();
        
        if($inProgressQuiz && $inProgressQuiz->multiplayerQuiz && $inProgressQuiz->multiplayerQuiz->status === 'in_progress') {
            $this->inProgressQuiz = $inProgressQuiz->multiplayerQuiz;
        } else {
            $this->inProgressQuiz = null;
        }
    }

    public function getInProgressQuizUrl()
    {
        if ($this->inProgressQuiz && $this->inProgressQuiz->status === 'in_progress') {
            return route('quiz.multiplayer.player.start', ['quizId' => $this->inProgressQuiz->id]);
        }
        return null;
    }

    public function createLobby()
    {
        $this->redirect(route('quiz.multiplayer.host.create'), navigate: true);
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.home');
    }
}