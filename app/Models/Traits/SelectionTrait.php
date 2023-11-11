<?php

namespace App\Models\Traits;

use App\Models\Contest;
use App\Models\Game;
use App\Models\Team;

trait SelectionTrait
{

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function favorite()
    {
        return $this->hasOne(Team::class, 'id', 'favorite_id');
    }

}