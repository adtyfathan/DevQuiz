<?php

namespace App\Livewire\Quiz\Multiplayer\Host;

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
        
        if(Auth::user()->id !== $this->host->id){
            abort(403, 'You are not the host of this lobby.');
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

    public function deleteLobby()
    {
        $quizLobby = MultiplayerQuiz::find($this->quiz->id);
        
        $quizLobby->delete();

        $this->redirect(route('home'), navigate: true);
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.host.lobby');
    }
}