<?php

namespace App\Models\Traits;

use App\Models\Game;
use App\Models\Team;
use App\Models\Conference;
use Illuminate\Support\Facades\Cache;

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

    public static function byAbbreviation($abbr)
    {
        // One week cache
        return Cache::remember('team:abbr:' . $abbr, 604800, function () use($abbr){
            return Team::where('abbreviation', $abbr)->first();
        });
    }

}