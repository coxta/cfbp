<?php

namespace App\Models\Traits;

use App\Models\Division;
use App\Models\Team;

trait ConferenceTrait
{

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}