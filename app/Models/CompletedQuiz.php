<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CompletedQuiz extends Model
{
    protected $table = "completed_quiz";
    protected $fillable = [
        'user_id',
        'score',
        'category',
        'difficulty',
        'completed_at'
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}