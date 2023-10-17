<?php

namespace App\Models\Traits;

use App\Models\Week;
use App\Models\Calendar;
use App\Models\Conference;
use App\Models\Team;

trait GameTrait
{

    protected static function boot()
    {
        parent::boot();

        // Game Ids and Calendar Details
        static::creating(function ($game) {

            $calendar_id = Calendar::select('id')
                ->whereDate('start_date', '<=', $game->start_date)
                ->whereDate('end_date', '>=', $game->start_date)
                ->first()
                ->id;

            $week_id = Week::select('id')
                ->where('calendar_id', $calendar_id)
                ->whereDate('start_date', '<=', $game->start_date)
                ->whereDate('end_date', '>=', $game->start_date)
                ->first()
                ->id;

            $game->calendar_id = $calendar_id;
            $game->week_id = $week_id;

        });
    }

    public function homeTeam()
    {
        return $this->hasOne(Team::class, 'id', 'home_team');
    }

    public function homeConference()
    {
        return $this->hasOneThrough(
            Conference::class,
            Team::class,
            'id',
            'id',
            'home_team',
            'conference_id'
        );
    }

    public function awayTeam()
    {
        return $this->hasOne(Team::class, 'id', 'away_team');
    }

    public function awayConference()
    {
        return $this->hasOneThrough(
            Conference::class,
            Team::class,
            'id',
            'id',
            'away_team',
            'conference_id'
        );
    }

    public function favorite()
    {
        return $this->hasOne(Team::class, 'id', 'favorite_team');
    }

    public function favoriteConference()
    {
        return $this->hasOneThrough(
            Conference::class,
            Team::class,
            'id',
            'id',
            'favorite_team',
            'conference_id'
        );
    }

}