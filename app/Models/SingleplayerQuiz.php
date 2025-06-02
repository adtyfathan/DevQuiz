<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TemporalQuiz;

class SingleplayerQuiz extends Model
{
    protected $table = "singleplayer_quiz";

    protected $fillable = [
        'user_id',
        'category',
        'difficulty',
        'started_at',
        'finished_at'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function temporalQuiz()
    {
        return $this->hasMany(TemporalQuiz::class, 'quiz_id');
    }
}