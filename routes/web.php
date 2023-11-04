<?php

use App\Livewire\Rankings;
use App\Livewire\ShowGame;
use App\Livewire\ShowTeam;
use App\Livewire\Pickem\ShowGroup;
use App\Livewire\Pickem\ShowContest;
use App\Livewire\Scoreboard;
use App\Livewire\Teams;

use App\Livewire\Pickem\Lobby;

use App\Livewire\Feeds\Feeds;
use App\Livewire\Feeds\ShowFeed;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use App\Livewire\ViewArticle;

// PowerGrids
use App\Livewire\UserTable;

// Autenticated user must be verified
Route::middleware(['verified'])->group(function () {

    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/articles/{article}', ViewArticle::class)->name('article');

    Route::get('/games', Scoreboard::class)->name('games');
    Route::get('/games/{game}', ShowGame::class)->name('game');
    Route::get('/teams', Teams::class)->name('teams');
    Route::get('/teams/{team}', ShowTeam::class)->name('team');
    Route::get('/rankings', Rankings::class)->name('rankings');

    Route::get('/lobby', Lobby::class)->name('lobby');

    Route::get('/groups/{group}', ShowGroup::class)->name('group');

    Route::get('/contests/{contest}', ShowContest::class)->name('contest');

    // Route::get('/schedule', Schedule::class)->name('schedule');
    // Route::get('/standings', Standings::class)->name('standings');

});

// Admin Only Routes
Route::middleware(['admin','verified'])->group(function () {
    Route::get('/feeds', Feeds::class)->name('feeds');
    Route::get('/feeds/{feed}', ShowFeed::class)->name('feed');
    Route::get('/feeds/{feed}/run', [FeedController::class, 'run'])->name('feed-run');

    // PowerGrids for Models
    Route::group(['background' => 'bg-white'], function () {
        Route::get('/users', UserTable::class)->name('users');
    });

});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
