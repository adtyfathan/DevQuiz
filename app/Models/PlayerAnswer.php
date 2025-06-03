<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Question;
use App\Models\MultiplayerQuiz;
use App\Models\SingleplayerQuiz;

class PlayerAnswer extends Model
{
    protected $table = "player_answer";
    protected $fillable = [
        'player_id',
        'question_id',
        'multiplayer_quiz_id',
        'singleplayer_quiz_id',
        'quiz_type',
        'answer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
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