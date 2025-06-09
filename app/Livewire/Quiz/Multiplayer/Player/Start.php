<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\MultiplayerQuiz;
use App\Models\MultiplayerPlayer;
use App\Models\CompletedQuiz;
use App\Models\PlayerAnswer;
use Illuminate\Support\Facades\Auth;

class Start extends Component
{
    public $quiz;
    public $player;
    public $playerQuiz;

    public function mount($quizId)
    {
        $this->quiz = MultiplayerQuiz::find($quizId);
        $this->player = Auth::user();
        $this->playerQuiz = MultiplayerPlayer::where('multiplayer_quiz_id', $this->quiz->id)
            ->where('player_id', $this->player->id)
            ->first();
    }
    
    public function handlePlayerAnswer($point, $userAnswer, $isCorrect, $questionId)
    {
        $playerAnswer = PlayerAnswer::where('player_id', $this->player->id)
            ->where('question_id', $questionId)
            ->where('multiplayer_quiz_id', $this->quiz->id)
            ->first();
        
        $playerAnswer->update([
            'answer' => $userAnswer,
            'is_correct' => $isCorrect,
            'point' => $point
        ]);

        $multiplayerPlayer = MultiplayerPlayer::where('player_id', $this->player->id)
            ->where('multiplayer_quiz_id', $this->quiz->id)
            ->first();

        $newPoint = $multiplayerPlayer->point + $point;

        $multiplayerPlayer->update([
            'point' => $newPoint
        ]);
    }

    public function endQuiz()
    {
        $trueAnswerCount = 0;
        $point = 0;
        
        $playerAnswers = PlayerAnswer::where('player_id', $this->player->id)
            ->where('multiplayer_quiz_id', $this->quiz->id)
            ->get();
            
        foreach($playerAnswers as $playerAnswer){
            if($playerAnswer->is_correct){
                $trueAnswerCount++;
                $point += $playerAnswer->point;
            }
        }

        $completedQuiz = CompletedQuiz::where('user_id', $this->player->id)
            ->where('multiplayer_quiz_id', $this->quiz->id)
            ->first();
    
        $completedQuiz->update([
            'score' => $point,
            'true_answer_count' => $trueAnswerCount,
            'completed_at' => now()
        ]);
        
        $this->redirect(
            route('quiz.multiplayer.player.summary', [
                'completedQuizId' => $completedQuiz->id
            ]), 
            navigate: true
        );
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.player.start', [
            'questionDuration' => $this->quiz->question_duration
        ]);
    }
}