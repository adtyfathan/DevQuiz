<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Events\PlayerLeaveLobby;
use App\Models\MultiplayerQuiz;
use App\Models\MultiplayerPlayer;

class Lobby extends Component
{ 
    public $lobbyCode;
    public $quiz;
    public $host;
    public $players = [];

    public function mount($lobbyCode)
    {
        $this->lobbyCode = $lobbyCode;

        $this->getLobbyData();

        if(Auth::user()->id === $this->host->id){
            abort(403, 'Host cant join the lobby.');
        }

        $isJoined = MultiplayerPlayer::where('player_id', Auth::user()->id)
            ->where('multiplayer_quiz_id', $this->quiz->id)
            ->exists();
        
        if(!$isJoined) abort(403, 'You must join the quiz first.');
    }

    public function playerChanged($data)
    {
        $this->setPlayersData();
    }
    
    public function leaveLobby()
    {
        $playerData = MultiplayerPlayer::where('player_id', Auth::user()->id)
            ->where('multiplayer_quiz_id', $this->quiz->id)
            ->first();
        
        broadcast(new PlayerLeaveLobby($this->quiz, $playerData));

        $playerData->delete();

        $this->redirect(route('home'), navigate: true);
    }
    
    public function getLobbyData()
    {
        $this->quiz = MultiplayerQuiz::with(
            'multiplayerPlayer',
                'host'
            )
            ->where('lobby_code', $this->lobbyCode)
            ->where('status', 'waiting')
            ->first();
        
        if(!$this->quiz) abort(404, 'Quiz not found.');
        
        $this->setPlayersData();

        $this->host = $this->quiz->host;
    }

    public function setPlayersData()
    {
        $this->quiz->load('multiplayerPlayer');
        $this->players = $this->quiz->multiplayerPlayer;
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.player.lobby');
    }
}