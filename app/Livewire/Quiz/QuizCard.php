<?php

namespace App\Livewire\Quiz;

use Livewire\Component;

class QuizCard extends Component
{
    public $category;
    public $img;
    public $difficulty = null;
    public $limit = null;
    public $isExpanded = false;
    
    protected $rules = [
        'difficulty' => 'required|in:easy,medium,hard',
        'limit' => 'required|in:5,10,15,20',
    ];
    
    public function mount($category, $img)
    {
        $this->category = $category;
        $this->img = $img;
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
        $this->validate();
    }

    public function render()
    {
        return view('livewire.quiz.quiz-card');
    }
}