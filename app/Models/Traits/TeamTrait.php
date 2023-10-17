<?php

namespace App\Models\Traits;

use App\Models\Game;
use App\Models\Conference;

trait TeamTrait
{

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function games()
    {
        return Game::whereJsonContains('teams', $this->id)->oldest('start_date');
    }
}