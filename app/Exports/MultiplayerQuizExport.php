<?php

namespace App\Exports;

use App\Models\CompletedQuiz;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiplayerQuizExport implements WithMultipleSheets
{
    protected $multiplayerQuizId;

    public function __construct($multiplayerQuizId)
    {
        $this->multiplayerQuizId = $multiplayerQuizId;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new SummaryExport($this->multiplayerQuizId);

        $completedQuizzes = CompletedQuiz::with([
            'multiplayerPlayer.player',
            'multiplayerQuiz' => function($query) {
                $query->with(['playerAnswers' => function($subQuery) {
                    $subQuery->where('multiplayer_quiz_id', $this->multiplayerQuizId)
                        ->with('question');
                }]);
            }
        ])->where('multiplayer_quiz_id', $this->multiplayerQuizId)
          ->orderBy('score', 'desc')
          ->get();

        foreach($completedQuizzes as $completedQuiz){
            $sheets[] = new PlayerAnswersExport(
                $completedQuiz->multiplayerPlayer->player,
                $completedQuiz->multiplayerPlayer,
                $this->multiplayerQuizId
            );
        }

        return $sheets;
    }
}