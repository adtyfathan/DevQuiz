<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Profile;
use App\Livewire\History;

// Singleplayer
use App\Livewire\Quiz\Singleplayer\Start as SingleStart;
use App\Livewire\Quiz\Singleplayer\Summary as SingleSummary;


// Host
use App\Livewire\Quiz\Multiplayer\Host\Lobby as HostLobby;
use App\Livewire\Quiz\Multiplayer\Host\Create as CreateLobby;
use App\Livewire\Quiz\Multiplayer\Host\Edit as EditLobby;
use App\Livewire\Quiz\Multiplayer\Host\Summary as HostSummary;

// Player
use App\Livewire\Quiz\Multiplayer\Player\Lobby as PlayerLobby;
use App\Livewire\Quiz\Multiplayer\Player\Start as QuizStart;
use App\Livewire\Quiz\Multiplayer\Player\Summary as PlayerSummary;

Route::middleware(['auth'])->group(function(){
    Route::get('/', Home::class)->name('home');

    Route::get('profile', Profile::class)->name('profile');

    Route::get('history', History::class)->name('history');
    
    Route::prefix('quiz')->name('quiz')->group(function(){
        Route::prefix('singleplayer')->name('.singleplayer')->group(function(){
            Route::get('start/{quizId}', SingleStart::class)->name('.start');
            Route::get('summary/{completedQuizId}', SingleSummary::class)->name('.summary');
        });

        Route::prefix('multiplayer')->name('.multiplayer')->group(function(){
            Route::prefix('player')->name('.player')->group(function(){
                Route::get('lobby/{lobbyCode}', PlayerLobby::class)->name('.lobby');
                Route::get('start/{quizId}', QuizStart::class)->name('.start');
                Route::get('summary/{completedQuizId}', PlayerSummary::class)->name('.summary');
            });

            Route::prefix('host')->name('.host')->group(function(){
                Route::get('lobby/{lobbyCode}', HostLobby::class)->name('.lobby');
                Route::get('create', CreateLobby::class)->name('.create');
                Route::get('edit/{lobbyId}', action: EditLobby::class)->name('.edit');
                Route::get('summary/{multiplayerQuizId}', HostSummary::class)->name('.summary');
            });
        });
    });
});

require __DIR__.'/auth.php';