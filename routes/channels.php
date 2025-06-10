<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\MultiplayerQuiz;
use App\Models\MultiplayerPlayer;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Private channel for quiz lobby
Broadcast::channel('quiz-lobby.{lobbyCode}', function ($user, $lobbyCode) {
    // Check if user is either the host or a joined player
    $quiz = MultiplayerQuiz::where('lobby_code', $lobbyCode)
        ->where('status', 'waiting')
        ->first();
    
    if (!$quiz) {
        return false;
    }
    
    // Allow if user is the host
    if ($quiz->host_id === $user->id) {
        return true;
    }
    
    // Allow if user is a joined player
    $player = MultiplayerPlayer::where('player_id', $user->id)
        ->where('multiplayer_quiz_id', $quiz->id)
        ->first();
    
    if ($player) {
        return true;
    }
    
    return false;
});

Broadcast::channel('multiplayer.{quizId}', function ($user, $quizId) {
    $quiz = MultiplayerQuiz::find($quizId);

    if (!$quiz) return false;

    if ($quiz->host_id === $user->id) {
        return true;
    }

   return true;
});

Broadcast::channel('quiz-ended.{quizId}', function ($user, $quizId) {
    $quiz = MultiplayerQuiz::find($quizId);

    if (!$quiz) return false;

    return true;
});

Broadcast::channel('quiz.{quizId}', function ($user, $quizId) {
    $quiz = MultiplayerQuiz::find($quizId);

    if (!$quiz) return false;

   return MultiplayerPlayer::where('multiplayer_quiz_id', $quizId)
        ->where('player_id', $user->id)
        ->exists();
});