<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CompletedQuiz extends Model
{
    protected $table = "completed_quiz";
    protected $fillable = [
        'quiz_type',
        'user_id',
        'multiplayer_quiz_id',
        'singleplayer_quiz_id',
        'score',
        'true_answer_count',
        'category',
        'difficulty',
        'completed_at'
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }

    public function multiplayerQuiz()
    {
        return $this->belongsTo(MultiplayerQuiz::class, 'multiplayer_quiz_id');
    }
    public function singleplayerQuiz()
    {
        return $this->belongsTo(SingleplayerQuiz::class, 'singleplayer_quiz_id');
    }
}