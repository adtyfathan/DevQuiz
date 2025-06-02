<?php

namespace App\Livewire\Quiz\Multiplayer\Host;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Events\QuizStarted;
use App\Services\QuestionSchedulerService;
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

    public function playerChanged($data)
    {
        $this->setPlayersData();
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

    public function deleteLobby()
    {
        $quizLobby = MultiplayerQuiz::find($this->quiz->id);
        
        $quizLobby->delete();

        $this->redirect(route('home'), navigate: true);
    }

    public function startQuiz()
    {
        if($this->quiz->status !== 'waiting') abort(403, 'Quiz already started or finished.');
        
        $this->quiz->update([
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        broadcast(new QuizStarted($this->quiz));

        app(QuestionSchedulerService::class)->start($this->quiz);

        // tambah kode buat notify kuis mulai
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.host.lobby');
    }
}