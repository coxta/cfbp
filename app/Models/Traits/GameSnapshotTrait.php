<?php

namespace App\Models\Traits;

use App\Models\Week;
use App\Models\Calendar;

trait GameSnapshotTrait
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
}