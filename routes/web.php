<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Profile;

// Host Lobby
use App\Livewire\Quiz\Multiplayer\Host\Lobby as HostLobby;
use App\Livewire\Quiz\Multiplayer\Host\Create as CreateLobby;
use App\Livewire\Quiz\Multiplayer\Host\Edit as EditLobby;

// Player Lobby
use App\Livewire\Quiz\Multiplayer\Player\Lobby as PlayerLobby;


Route::middleware(['auth'])->group(function(){
    Route::get('/', Home::class)->name('home');

    Route::get('profile', Profile::class)->name('profile');
    
    Route::prefix('quiz')->name('quiz')->group(function(){
        Route::prefix('singleplayer')->name('.singleplayer')->group(function(){
            // Singleplayer routes
        });

        Route::prefix('multiplayer')->name('.multiplayer')->group(function(){
            Route::prefix('player')->name('.player')->group(function(){
                Route::get('lobby/{lobbyCode}', PlayerLobby::class)->name('.lobby');
            });

            Route::prefix('host')->name('.host')->group(function(){
                Route::get('lobby/{lobbyCode}', HostLobby::class)->name('.lobby');
                Route::get('create', CreateLobby::class)->name('.create');
                Route::get('edit/{lobbyId}', EditLobby::class)->name('.edit');
            });
        });
    });
});

require __DIR__.'/auth.php';