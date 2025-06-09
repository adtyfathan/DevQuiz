<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\CompletedQuiz;
use App\Models\MultiplayerQuiz;

use function PHPUnit\Framework\isEmpty;

class Summary extends Component
{
    public $playerId;
    public $completedQuiz;
    public $username;
    public $totalQuestions;
    public $trueCount;
    public $falseCount;
    public $accuracy;
    public $point;
    public $playerAnswers = [];
    
    public function mount($completedQuizId)
    {
        $this->playerId = Auth::user()->id;

        $this->completedQuiz = CompletedQuiz::with([
            'multiplayerQuiz.playerData',
            'multiplayerQuiz.multiplayerPlayer',
            'multiplayerQuiz' => function($query) {
                $query->with(['playerAnswers' => function($subQuery) {
                    $subQuery->where('player_id', $this->playerId)->with('question');
                }]);
            }
        ])->findOrFail($completedQuizId);

        if(!$this->completedQuiz) abort(404, 'Summary not found.');

        if($this->completedQuiz->user_id !== $this->playerId) abort(403, 'You are not authorized to view this summary.');
        
        $this->getSummaryData();
    }

    public function getSummaryData()
    {
        // username
        $this->username = $this->completedQuiz->multiplayerQuiz->playerData->username;

        // answer state & accuracy
        $this->totalQuestions = $this->completedQuiz->multiplayerQuiz->total_questions;
        $this->trueCount = $this->completedQuiz->true_answer_count;
        $this->falseCount = $this->totalQuestions - $this->trueCount;
        
        $this->accuracy = $this->trueCount / $this->totalQuestions * 100;

        // point
        $this->point = $this->completedQuiz->score;

        // player answers
        $this->playerAnswers = $this->completedQuiz->multiplayerQuiz->playerAnswers;
    }


    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.player.summary');
    }
}