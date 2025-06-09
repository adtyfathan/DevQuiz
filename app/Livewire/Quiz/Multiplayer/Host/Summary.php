<?php

namespace App\Livewire\Quiz\Multiplayer\Host;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\CompletedQuiz;
use App\Models\MultiplayerPlayer;
use App\Models\MultiplayerQuiz;
use App\Exports\MultiplayerQuizExport;
use Maatwebsite\Excel\Facades\Excel;

class Summary extends Component
{
    public $completedQuizzes;
    public $multiplayerQuizId;
    public $averagePoints = 0;
    public $averageAccuracy = 0;
    public $selectedPlayerId = '';
    public $selectedPlayerQuiz = null; // Add this property
    
    public function mount($multiplayerQuizId)
    {
        $multiplayerQuizId = MultiplayerQuiz::findOrFail($multiplayerQuizId)->id;
        $this->multiplayerQuizId = $multiplayerQuizId;

        $this->completedQuizzes = CompletedQuiz::with([
            'multiplayerPlayer',
            'multiplayerQuiz' => function($query) use ($multiplayerQuizId) {
                $query->with(['playerAnswers' => function($subQuery) use ($multiplayerQuizId) {
                    $subQuery->where('multiplayer_quiz_id', $multiplayerQuizId)
                        ->with('question');
                }]);
            }
        ])->where('multiplayer_quiz_id', $multiplayerQuizId)
        ->orderBy('score', 'desc')
        ->get();

        if($this->completedQuizzes->isEmpty()) {
            abort(404, 'Summary not found.');
        }

        if($this->completedQuizzes->first()->multiplayerQuiz->host_id !== Auth::user()->id) {
            abort(403, 'You are not authorized to view this summary.');
        }

        $this->getSummaryData();
    }

    // Add this method to handle player selection changes
    public function updatedSelectedPlayerId($value)
    {
        if ($value) {
            $this->selectedPlayerQuiz = $this->completedQuizzes->firstWhere('id', $value);
        } else {
            $this->selectedPlayerQuiz = null;
        }
    }

    public function getSummaryData()
    {
        $totalPoints = 0;
        $totalAccuracy = 0;

        foreach($this->completedQuizzes as $completedQuiz){
            $totalPoints += $completedQuiz->score;

            $trueCount = $completedQuiz->true_answer_count;

            $totalQuestions = $completedQuiz->multiplayerQuiz->total_questions;

            $totalAccuracy += $trueCount / $totalQuestions * 100;
        }

        $this->averagePoints = $totalPoints / $this->completedQuizzes->count();

        $this->averageAccuracy = $totalAccuracy / $this->completedQuizzes->count();
    }

    public function downloadSummary()
    {
        $lobbyName = MultiplayerQuiz::find($this->multiplayerQuizId)->lobby_name;
        $filename = $lobbyName . '.xlsx';

        return Excel::download(new MultiplayerQuizExport($this->multiplayerQuizId), $filename);
    }
    
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.host.summary');
    }
}