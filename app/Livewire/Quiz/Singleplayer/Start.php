<?php

namespace App\Livewire\Quiz\Singleplayer;

use Livewire\Attributes\Layout;
use App\Models\SingleplayerQuiz;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\CompletedQuiz;
use App\Models\PlayerAnswer;
use Livewire\Component;

class Start extends Component
{
    public $quiz;
    public $player;
    public $questions;
    public $color = [];
    public $colorIndex;
    public $answers = [];
    public $correctAnswers;
    public $questionNumber = 0;
    public $playerAnswer;
    public $playerAnswers;
    protected $listeners = ['questionAnswered' => 'refreshQuestionData'];


    public function mount($quizId)
    {
        $this->quiz = SingleplayerQuiz::findOrFail($quizId);
        $this->player = Auth::user();

        $this->color = [
            'from-red-500 to-red-600 hover:from-red-600 hover:to-red-700',
            'from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700',
            'from-green-500 to-green-600 hover:from-green-600 hover:to-green-700',
            'from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700'
        ];
        
    }

    public function loadPlayerAnswers()
    {
        $this->playerAnswers = PlayerAnswer::with('question')
            ->where('player_id', $this->player->id)
            ->where('singleplayer_quiz_id', $this->quiz->id)
            ->get();
    }

    public function setCurrentQuestion()
    {
        $this->loadPlayerAnswers();

        foreach($this->playerAnswers as $index => $temp) {
            if (empty($temp->answer)) {
                $this->playerAnswer = $temp;
                $this->questionNumber = $index+1;

                $answersJson = json_decode($this->playerAnswer->question->answers, true);

                // Filter out null values dan format untuk tampilan
                $this->answers = collect($answersJson)
                    ->filter(fn($value) => !is_null($value)) // Remove null values
                    ->map(fn($value, $key) => [
                        'key' => $key,
                        'text' => $value
                    ])
                    ->values()
                    ->toArray();
                
                return;
            }
        }
    }

    public function handlePlayerAnswer($userAnswer, $point)
    {
        
        $correctAnswersJson = json_decode($this->playerAnswer->question->correct_answers, true);
        
        $this->correctAnswers = collect($correctAnswersJson)
            ->filter(fn($value) => $value === "true")
            ->keys() // Ambil key-nya saja
            ->map(fn($key) =>str_replace(['_correct'], '', $key)) // Remove "_correct"
            ->toArray();

        if ($this->correctAnswers[0] == $userAnswer) {
            $isCorrect = 1;
            $point = 100;
            $this->playerAnswer->update([
                'answer' => $userAnswer,
                'is_correct' => $isCorrect,
                'point' => $point
            ]);
        } else {
            $isCorrect = 0;
            $point = 0;
            $this->playerAnswer->update([
                'answer' => $userAnswer,
                'is_correct' => $isCorrect,
                'point' => $point
            ]);
        }

        foreach($this->playerAnswers as $index => $temp) {
            if (empty($temp->answer)) {
                $this->playerAnswer = $temp;
                $this->questionNumber = $index+1;

                $answersJson = json_decode($this->playerAnswer->question->answers, true);

                // Filter out null values dan format untuk tampilan
                $this->answers = collect($answersJson)
                    ->filter(fn($value) => !is_null($value)) // Remove null values
                    ->map(fn($value, $key) => [
                        'key' => $key,
                        'label' => strtoupper(str_replace('answer_', '', $key)), // A, B, C, D
                        'text' => $value
                    ])
                    ->values()
                    ->toArray();
                
                return;
            } elseif ($index === count($this->playerAnswers) - 1) {
                $this->endQuiz();
            }
        }
    }

    public function refreshQuestionData()
    {
        // Reload data dari database
        $this->loadPlayerAnswers();
        $this->setCurrentQuestion();
        
        // Force re-render component
        $this->render();
    }

    public function endQuiz()
    {
        $trueAnswerCount = 0;
        $point = 0;
        
        $this->loadPlayerAnswers();

        foreach($this->playerAnswers as $playerAnswer) {
            if ($playerAnswer->is_correct) {
                $trueAnswerCount++;
                $point += $playerAnswer->point; 
            }
        }

        $completedQuiz = CompletedQuiz::create([
            'quiz_type' => 'singleplayer',
            'user_id' => $this->player->id,
            'multiplayer_player_id' => null,
            'multiplayer_quiz_id' => null,
            'singleplayer_quiz_id' => $this->quiz->id,
            'score' => $point,
            'true_answer_count' => $trueAnswerCount,
            'category' => $this->quiz->category,
            'difficulty' => $this->quiz->difficulty,
            'completed_at' => now()
        ]);

        $this->quiz->update([
            'finished_at' => now()
        ]);

        $this->redirect(
            route('quiz.singleplayer.summary', [
                'completedQuizId' => $completedQuiz->id
            ]), 
            navigate: true
        );
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        $this->setCurrentQuestion();
        return view('livewire.quiz.singleplayer.start');
    }

}