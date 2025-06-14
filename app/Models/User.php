<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use App\Models\MultiplayerQuiz;
use App\Models\MultiplayerPlayer;
use App\Models\CompletedQuiz;
use App\Models\SingleplayerQuiz;
use App\Models\TemporalQuiz;
use App\Models\PlayerAnswer;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function host()
    {
        return $this->hasMany(MultiplayerQuiz::class, 'host_id');
    }

    public function multiplayerPlayer()
    {
        return $this->hasMany(MultiplayerPlayer::class, 'player_id');
    }

    public function completedQuiz()
    {
        return $this->hasMany(CompletedQuiz::class, 'user_id');
    }

    public function singleplayerQuiz()
    {
        return $this->hasMany(SingleplayerQuiz::class, 'user_id');
    }

    public function temporalQuiz()
    {
        return $this->hasMany(TemporalQuiz::class, 'user_id');
    }

    public function playerAnswer()
    {
        return $this->hasMany(PlayerAnswer::class, 'player_id');
    }
}