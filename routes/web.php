<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Routes nécessitant une authentification
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Gestion des sondages
    |--------------------------------------------------------------------------
    */

    Route::get('/polls/create', [PollController::class, 'create'])
        ->name('polls.create');

    Route::post('/polls', [PollController::class, 'store'])
        ->name('polls.store');

    Route::get('/polls/{poll:slug}/edit', [PollController::class, 'edit'])
        ->name('polls.edit');

    Route::put('/polls/{poll:slug}', [PollController::class, 'update'])
        ->name('polls.update');

    Route::patch('/polls/{poll:slug}/close', [PollController::class, 'close'])
        ->name('polls.close');

    Route::delete('/polls/{poll:slug}', [PollController::class, 'destroy'])
        ->name('polls.destroy');


    /*
    |--------------------------------------------------------------------------
    | Profil
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Sondages publics
|--------------------------------------------------------------------------
|
| Un utilisateur peut :
| - consulter un sondage ;
| - voter sans compte ;
| - consulter les résultats.
|
*/

Route::get('/polls/{poll:slug}', [PollController::class, 'show'])
    ->name('polls.show');

Route::post('/polls/{poll:slug}/vote', [PollController::class, 'vote'])
    ->name('polls.vote');

Route::get('/polls/{poll:slug}/results', [PollController::class, 'results'])
    ->name('polls.results');


require __DIR__.'/auth.php';