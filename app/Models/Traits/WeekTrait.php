<?php

namespace App\Models\Traits;

use App\Models\Game;
use App\Models\Week;
use App\Models\Calendar;
use Illuminate\Support\Facades\Cache;

trait WeekTrait
{

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public static function current()
    {
        return Cache::remember('week:current', now()->addHours(12), function () {
            return Week::where('start_date', '<=', now())->where('end_date', '>=', now())->first();
        });

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