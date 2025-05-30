<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MultiplayerPlayer;

class MultiplayerQuiz extends Model
{
    protected $table = "multiplayer_quiz";
    protected $fillable = [
        'host_id',
        'category',
        'difficulty',
        'total_questions',
        'lobby_code',
        'lobby_name',
        'lobby_description',
        'status',
        'show_score',
        'show_review',
        'allow_multiple_attempt',
        'question_duration',
        'started_at',
        'finished_at'
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function multiplayerPlayer()
    {
        return $this->hasMany(MultiplayerPlayer::class, 'multiplayer_quiz_id');
    }
}