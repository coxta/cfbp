<?php

use App\Livewire\Rankings;
use App\Livewire\Schedule;
use App\Livewire\ShowGame;
use App\Livewire\ShowTeam;

use App\Livewire\Feeds\Feeds;
use App\Livewire\Feeds\ShowFeed;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use App\Livewire\Scoreboard;
use App\Livewire\Standings;
use App\Livewire\Teams;

// Autenticated user must be verified
Route::middleware(['verified'])->group(function () {

    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/games', Scoreboard::class)->name('games');
    Route::get('/games/{game}', ShowGame::class)->name('game');
    Route::get('/teams', Teams::class)->name('teams');
    Route::get('/teams/{team}', ShowTeam::class)->name('team');
    Route::get('/rankings', Rankings::class)->name('rankings');

    // Route::get('/schedule', Schedule::class)->name('schedule');
    // Route::get('/standings', Standings::class)->name('standings');

});

// Admin Only Routes
Route::middleware(['admin','verified'])->group(function () {
    Route::get('/feeds', Feeds::class)->name('feeds');
    Route::get('/feeds/{feed}', ShowFeed::class)->name('feed');
    Route::get('/feeds/{feed}/run', [FeedController::class, 'run'])->name('feed-run');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
