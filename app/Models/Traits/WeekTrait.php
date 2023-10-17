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
}