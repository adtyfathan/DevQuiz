<?php

namespace App\Livewire\Quiz\Multiplayer\Host;

use Illuminate\Support\Facades\Auth;
use App\Models\MultiplayerQuiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public $category = 'Code'; // Set default value
    public $difficulty = 'easy'; // Set default value
    public $total_questions;
    public $lobby_name;
    public $lobby_description;
    public $show_score = 'true';
    public $show_review = 'true';
    public $question_duration;
    public $errorMessage = '';

    public $lobby_code;
    public $status = 'waiting';

    // Validation rules
    protected $rules = [
        'category' => 'required|string',
        'difficulty' => 'required|in:easy,medium,hard',
        'total_questions' => 'required|integer|min:1|max:20',
        'lobby_name' => 'required|string|max:255',
        'lobby_description' => 'nullable|string|max:1000',
        'show_score' => 'required|in:true,false', 
        'show_review' => 'required|in:true,false', 
        'question_duration' => 'required|integer|min:10|max:60',
    ];

    // Real-time validation messages
    protected $messages = [
        'category.required' => 'Please select a quiz category.',
        'difficulty.required' => 'Please select a difficulty level.',
        'difficulty.in' => 'Please select a valid difficulty level.',
        'total_questions.required' => 'Please enter the number of questions.',
        'total_questions.integer' => 'Total questions must be a number.',
        'total_questions.min' => 'Minimum 1 question is required.',
        'total_questions.max' => 'Maximum 20 questions allowed.',
        'lobby_name.required' => 'Please enter a lobby name.',
        'lobby_name.max' => 'Lobby name cannot exceed 255 characters.',
        'lobby_description.max' => 'Description cannot exceed 1000 characters.',
        'show_score.required' => 'Please select score visibility option.',
        'show_score.in' => 'Please select a valid score visibility option.',
        'show_review.required' => 'Please select review visibility option.',
        'show_review.in' => 'Please select a valid review visibility option.',
        'question_duration.required' => 'Please set question duration.',
        'question_duration.integer' => 'Question duration must be a number.',
        'question_duration.min' => 'Minimum duration is 10 seconds.',
        'question_duration.max' => 'Maximum duration is 60 seconds.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createLobby()
    {
        // Validate all fields
        $validatedData = $this->validate();

        // Generate lobby code
        $this->lobby_code = $this->generateLobbyCode();

        try {
            $quizLobby = MultiplayerQuiz::create([
                'host_id' => Auth::user()->id,
                'category' => $this->category,
                'difficulty' => $this->difficulty,
                'total_questions' => $this->total_questions,
                'lobby_code' => $this->lobby_code,
                'lobby_name' => $this->lobby_name,
                'lobby_description' => $this->lobby_description,
                'status' => 'waiting',
                'show_score' => $this->show_score === 'true', // Convert to boolean
                'show_review' => $this->show_review === 'true', // Convert to boolean
                'allow_multiple_attempt' => false,
                'question_duration' => $this->question_duration,
                'started_at' => null,
                'finished_at' => null
            ]);

            // Reset form after successful creation
            $this->reset();
             
            $this->redirect(route('quiz.multiplayer.host.lobby', ['lobbyCode' => $quizLobby->lobby_code]), navigate: true);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create quiz lobby. Please try again.');
        }
    }

    private function generateLobbyCode()
    {
        do {
            $lobbyCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (MultiplayerQuiz::where('lobby_code', $lobbyCode)->exists());

        return $lobbyCode;
    }
    
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.host.create');
    }
}