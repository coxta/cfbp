<?php

namespace App\Models\Traits;

use App\Models\Week;

trait CalendarTrait
{

    public function weeks()
    {
        return $this->hasMany(Week::class);
    }
}