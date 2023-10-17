<?php

namespace App\Models\Traits;

use App\Models\Team;

trait RankingTrait
{

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}