<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SingleplayerQuiz;
use App\Models\Question;

class TemporalQuiz extends Model
{
    protected $table = "temporal_quiz";

    protected $fillable = [
        'user_id',
        'quiz_id',
        'question_id',
        'answer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function singleplayerQuiz()
    {
        return $this->belongsTo(SingleplayerQuiz::class, 'quiz_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}