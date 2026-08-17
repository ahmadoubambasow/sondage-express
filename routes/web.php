<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/polls/create', [PollController::class, 'create'])
        ->name('polls.create');
    
    Route::get('/polls/{poll:slug}', [PollController::class, 'show'])
        ->name('polls.show');

    Route::get('/polls/{poll:slug}/edit', [PollController::class, 'edit'])
        ->name('polls.edit');
    
    Route::put('/polls/{poll:slug}', [PollController::class, 'update'])
        ->name('polls.update');

    Route::delete('/polls/{poll:slug}', [PollController::class, 'destroy'])
        ->name('polls.destroy');

    Route::post('/polls', [PollController::class, 'store'])
        ->name('polls.store');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';