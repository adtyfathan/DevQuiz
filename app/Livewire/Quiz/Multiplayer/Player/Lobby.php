<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\MultiplayerQuiz;

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
            
        $this->players = $this->quiz->multiplayerPlayer;

        $this->host = $this->quiz->host;
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.player.lobby');
    }
}