<?php

namespace App\Models\Traits;

use App\Models\Conference;
use App\Models\Team;

trait DivisionTrait
{

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}