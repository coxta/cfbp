<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Ranking;
use App\Models\Calendar;

class RankingsController extends Controller
{
    
    public static function defaultPoll()
    {
        // One day cache
        return Cache::remember('poll:default', 86400, function () {
            $cals = Calendar::where('year', config('espn.season'))->pluck('id');
            return Ranking::where('poll', 'cfp')->whereIn('calendar_id', $cals)->exists() ? 'cfp' : 'ap';
        });
    }
}
