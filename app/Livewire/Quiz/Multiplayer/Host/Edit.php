<?php

namespace App\Livewire\Quiz\Multiplayer\Host;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\MultiplayerQuiz;

class Edit extends Component
{
    public $category;
    public $difficulty;
    public $total_questions;
    public $lobby_name;
    public $lobby_description;
    public $show_score;
    public $show_review;
    public $question_duration;
    public $errorMessage = '';
    public $lobbyId;

    public function mount($lobbyId)
    {
        $this->lobbyId = $lobbyId;
        
        $lobbyData = MultiplayerQuiz::where('id', $lobbyId)
            ->where('host_id', Auth::user()->id)
            ->first();

        if (!$lobbyData) {
            abort(404, 'Quiz lobby not found or you do not have permission to edit it.');
        }

        if ($lobbyData->status !== 'waiting') {
            abort(403, 'Cannot edit lobby that already started or finished.');
        }

        $this->category = $lobbyData->category;
        $this->difficulty = $lobbyData->difficulty;
        $this->total_questions = $lobbyData->total_questions;
        $this->lobby_name = $lobbyData->lobby_name;
        $this->lobby_description = $lobbyData->lobby_description;
        $this->show_score = $lobbyData->show_score ? 'true' : 'false';
        $this->show_review = $lobbyData->show_review ? 'true' : 'false';
        $this->question_duration = $lobbyData->question_duration;
    }

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

    public function updateLobby()
    {
        // Validate all fields
        $validatedData = $this->validate();

        try {
            $quizLobby = MultiplayerQuiz::find($this->lobbyId);

            $quizLobby->update([
                'category' => $this->category,
                'difficulty' => $this->difficulty,
                'total_questions' => $this->total_questions,
                'lobby_name' => $this->lobby_name,
                'lobby_description' => $this->lobby_description,
                'show_score' => $this->show_score === 'true', // Convert to boolean
                'show_review' => $this->show_review === 'true', // Convert to boolean
                'question_duration' => $this->question_duration,
            ]);
             
            $this->redirect(route('quiz.multiplayer.host.lobby', ['lobbyCode' => $quizLobby->lobby_code]), navigate: true);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create quiz lobby. Please try again.');
        }
    }
    
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.quiz.multiplayer.host.edit');
    }
}