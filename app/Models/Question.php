<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TemporalQuiz;

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
}