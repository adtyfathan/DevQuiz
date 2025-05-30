<?php

namespace App\Livewire\Quiz;

use Illuminate\Support\Facades\Auth;
use App\Models\MultiplayerPlayer;
use Livewire\Component;
use App\Models\MultiplayerQuiz;

class JoinLobby extends Component
{
    public $username = '';
    public $lobbyCode = '';
    public $errorMessage = '';

    protected $rules = [
        'username' => 'required|min:2|max:20',
        'lobbyCode' => 'required|digits:6',
    ];

    public function joinLobby()
    {
        $this->validate();

        $this->errorMessage = '';

        $multiplayerLobby = MultiplayerQuiz::where('lobby_code', $this->lobbyCode)
            ->where('status', 'waiting')
            ->first();

        if (!$multiplayerLobby) {
            $this->errorMessage = 'Quiz is not found';
            return;
        }

        $player = Auth::user();

        $playerId = $player->id;

        // is host
        if($multiplayerLobby->host_id === $playerId){
            $this->errorMessage = 'You are the host of this quiz';
            return;
        }

        $alreadyJoined = MultiplayerPlayer::where('player_id', $playerId)
            ->where('multiplayer_quiz_id', $multiplayerLobby->id)
            ->exists();

        if($alreadyJoined){
            $this->errorMessage = 'You already joined this quiz';
            return;
        }

        MultiplayerPlayer::create([
            'player_id' => $playerId,
            'multiplayer_quiz_id' => $multiplayerLobby->id,
            'username' => $this->username,
            'point' => null,
            'status' => 'waiting',
            'joined_at' => now(),
            'finished_at' => null
        ]);

        $this->redirect(route('quiz.multiplayer.player.lobby', ['lobbyCode' => $multiplayerLobby->lobby_code]), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.quiz.join-lobby');
    }
}