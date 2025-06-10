<?php

namespace App\Livewire\Quiz\Singleplayer;

use Livewire\Attributes\Layout;
use App\Models\SingleplayerQuiz;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\CompletedQuiz;
use App\Models\PlayerAnswer;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class Summary extends Component
{
    public $player;
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
        $this->player = Auth::user();

        $this->completedQuiz = CompletedQuiz::with([
            'singleplayerQuiz.playerAnswers' => function($query) {
                $query->where('player_id', $this->player->id)->with('question');
            }
        ])->findOrFail($completedQuizId);

        if(!$this->completedQuiz) abort(404, 'Summary not found.');

        if($this->completedQuiz->user_id !== $this->player->id) abort(403, 'You are not authorized to view this summary.');
        
        $this->getSummaryData();
    }

    public function getSummaryData()
    {
        // username
        $this->username = $this->player->name;

        // answer state & accuracy
        $this->totalQuestions = $this->completedQuiz->singleplayerQuiz->total_questions;
        $this->trueCount = $this->completedQuiz->true_answer_count;
        $this->falseCount = $this->totalQuestions - $this->trueCount;
        
        $this->accuracy = $this->trueCount / $this->totalQuestions * 100;

        // point
        $this->point = $this->completedQuiz->score;

        // player answers
        $this->playerAnswers = $this->completedQuiz->singleplayerQuiz->playerAnswers;
    }


    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.singleplayer.summary');
    }
}