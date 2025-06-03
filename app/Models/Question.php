<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TemporalQuiz;
use App\Models\PlayerAnswer;

class Question extends Model
{
    protected $table = "questions";
    protected $fillable = [
        'id',
        'question',
        'description',
        'answers',
        'correct_answers',
        'explanation',
        'category',
        'difficulty'
    ];

    public function temporalQuiz()
    {
        return $this->hasMany(TemporalQuiz::class, 'question_id');
    }

    public function playerAnswers()
    {
        return $this->hasMany(PlayerAnswer::class, 'question_id');
    }
}