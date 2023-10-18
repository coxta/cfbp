<?php

namespace App\Models\Traits;

use App\Models\Game;
use App\Models\Calendar;

trait WeekTrait
{

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class)->orderBy('start_date');
    }

    public function myGames()
    {
        return $this->hasMany(Game::class)
                    ->whereIn('away_team', auth()->user()->teams ?? [])
                    ->orWhereIn('home_team', auth()->user()->teams ?? [])
                    ->orderBy('start_date');
    }
}