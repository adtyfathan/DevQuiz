<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Profile;

Route::get('/', Home::class)
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('profile', Profile::class)
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';