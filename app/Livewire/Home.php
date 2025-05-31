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

    public function mount()
    {
        $user = Auth::user();

        $this->userId = $user->id;

        $this->getHostedQuiz();

        $this->getJoinedQuiz();
    }

    public function getHostedQuiz()
    {
        $this->hostedQuiz = MultiplayerQuiz::where('host_id', $this->userId)
            ->where('status', 'waiting')
            ->first();
    }

    public function getHostedQuizUrl()
    {
        $hostedLobby = MultiplayerQuiz::where('host_id', $this->userId)
            ->where('status', 'waiting')
            ->first();

        if ($hostedLobby) {
            return route('quiz.multiplayer.host.lobby', ['lobbyCode' => $hostedLobby->lobby_code]);
        }
        return null;
    }
    
    
    public function getJoinedQuiz()
    {
        $playerQuiz = MultiplayerPlayer::with('multiplayerQuiz')
            ->where('player_id', $this->userId)
            ->where('status', 'waiting')
            ->first();
        
        if ($playerQuiz && $playerQuiz->multiplayerQuiz) {
            $this->joinedQuiz = $playerQuiz->multiplayerQuiz;
        } else {
            $this->joinedQuiz = null;
        }
    }

    public function getRejoinQuizUrl()
    {
        $ongoingQuiz = MultiplayerPlayer::with('multiplayerQuiz')
            ->where('player_id', $this->userId)
            ->where('status', 'waiting')
            ->first();
        
        if ($ongoingQuiz && $ongoingQuiz->multiplayerQuiz) {
            return route('quiz.multiplayer.player.lobby', ['lobbyCode' => $ongoingQuiz->multiplayerQuiz->lobby_code]);
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