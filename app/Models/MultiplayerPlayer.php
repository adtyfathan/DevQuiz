<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MultiplayerQuiz;
use App\Models\CompletedQuiz;

class MultiplayerPlayer extends Model
{
    protected $table = "multiplayer_player";
    protected $fillable = [
        'player_id',
        'multiplayer_quiz_id',
        'username',
        'point',
        'status',
        'joined_at',
        'finished_at'
    ];

    public function player()
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function multiplayerQuiz()
    {
        return $this->belongsTo(MultiplayerQuiz::class, 'multiplayer_quiz_id');
    }

    public function completedQuiz()
    {
        return $this->hasOne(CompletedQuiz::class, 'multiplayer_player_id');
    }
}