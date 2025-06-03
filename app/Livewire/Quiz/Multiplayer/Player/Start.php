<?php

namespace App\Livewire\Quiz\Multiplayer\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\MultiplayerQuiz;
use App\Models\MultiplayerPlayer;
use App\Models\CompletedQuiz;
use App\Models\PlayerAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Start extends Component
{
    public $quiz;
    public $player;
    public $currentQuestion = 0;
    public $totalPoints = 0;
    public $playerQuiz;
    public $questions = [];

    public function mount($quizId)
    {
        $this->quiz = MultiplayerQuiz::findOrFail($quizId);
        $this->player = Auth::user();
        $this->playerQuiz = MultiplayerPlayer::where('multiplayer_quiz_id', $this->quiz->id)
            ->where('player_id', $this->player->id)
            ->first();
        // Clear previous answers
        $this->clearPreviousAnswers();
    }
    
    public function handlePlayerAnswer($point, $userAnswer, $isCorrect, $questionId)
    {
        $cacheKey = $this->getAnswersCacheKey();
        $answers = Cache::get($cacheKey, []);

        $answers[] = [
            'answer' => $userAnswer,
            'is_correct' => $isCorrect,
            'point' => $point,
            'time' => now()->toDateTimeString(),
            'question_number' => $this->currentQuestion,
            'question_id' => $questionId  // Add question ID to cached data
        ];

        Cache::put($cacheKey, $answers, now()->addMinutes(25));
        
        $this->totalPoints += $point;

        $this->playerQuiz->update([
            'point' => $this->totalPoints
        ]);

        $this->player->update(['point' => $this->totalPoints]);
    }

    private function getAnswersCacheKey(): string
    {
        return "quiz_session:{$this->quiz->id}:user:{$this->player->id}:answers";
    }

    private function clearPreviousAnswers(): void
    {
        Cache::forget($this->getAnswersCacheKey());
    }

    public function endQuiz()
    {
        $savedAnswers = [];
        $trueAnswerCount = 0;
        $score = 0;
        
        $cacheKey = $this->getAnswersCacheKey();
        $answers = Cache::get($cacheKey, []);
        
        foreach ($answers as $answer) {
            array_push($savedAnswers, $answer['answer']);
            if ($answer['is_correct']) {
                $trueAnswerCount++;
                $score += $answer['point'];
            }
        };

        foreach ($savedAnswers as $savedAnswer){
            PlayerAnswer::create([
                'player_id' => $this->player->id,
                'question_id' => $answer['question_id'],
                'multiplayer_quiz_id' => $this->quiz->id,
                'singleplayer_quiz_id' => null,
                'quiz_type' => 'multiplayer',
                'answer' => $savedAnswer
            ]);
        }

        CompletedQuiz::create([
            'quiz_type' => 'multiplayer',
            'user_id' => $this->player->id,
            'multiplayer_quiz_id' => $this->quiz->id,
            'single_player_quiz_id' => null,
            'score' => $score,
            'true_answer_count' => $trueAnswerCount,
            'category' => $this->quiz->category,
            'difficulty' => $this->quiz->difficulty,
            'completed_at' => now()
        ]);

        Cache::forget($cacheKey);

        $this->quiz->update([
            'status' => 'finished'
        ]);
        
        $this->redirect(
            route('home'), 
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