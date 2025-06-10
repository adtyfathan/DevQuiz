<?php

namespace App\Livewire\Quiz;

use App\Models\SingleplayerQuiz;
use Illuminate\Support\Facades\Auth;
use App\Services\QuizService;
use App\Models\Question;
use Livewire\Component;
use App\Models\PlayerAnswer;

class QuizCard extends Component
{
    public $category;
    public $img;
    public $difficulty = null;
    public $limit = null;
    public $isExpanded = false;
    public $playerId;
    protected $rules = [
        'difficulty' => 'required|in:easy,medium,hard',
        'limit' => 'required|in:5,10,15,20',
    ];
    
    public function mount($category, $img)
    {
        $this->category = $category;
        $this->img = $img;
        $this->playerId = Auth::user()->id;
    }
    
    public function toggleExpanded()
    {
        $this->isExpanded = !$this->isExpanded;
    }
    
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function handleSubmit()
    {
            $quiz = SingleplayerQuiz::create([
                'user_id' => $this->playerId,
                'category' => $this->category,
                'difficulty' => $this->difficulty,
                'started_at' => now(),
                'finished_at' => null,
                'total_questions' => $this->limit
            ]);

            $quizService = app(QuizService::class);

            $questions = $quizService->fetchQuestions(
                $quiz->category, 
                $quiz->difficulty, 
                $quiz->total_questions
            );
            
            foreach ($questions as $question) {
                Question::firstOrCreate(
                    ['id' => $question['id']],
                    [
                        'question' => $question['question'],
                        'category' => $question['category'],
                        'difficulty' => $question['difficulty'],
                        'description' => $question['description'],
                        'answers' => json_encode($question['answers']),
                        'correct_answers' => json_encode($question['correct_answers']),
                        'explanation' => $question['explanation']
                    ]
                );

                PlayerAnswer::create([
                    'player_id' => $this->playerId,
                    'question_id' => $question['id'],
                    'multiplayer_quiz_id' => null,
                    'singleplayer_quiz_id' => $quiz->id,
                    'quiz_type' => 'singleplayer',
                    'answer' => null,
                    'is_correct' => false,
                    'point' => 0
                ]);
            }
            
            if ($quiz) {
                $this->redirect(
                    route('quiz.singleplayer.start', ['quizId' => $quiz->id]), 
                    navigate: true
                );
            }
    }

    public function render()
    {
        return view('livewire.quiz.quiz-card');
    }
}