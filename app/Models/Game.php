<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Traits\GameTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Game extends Model
{

    use GameTrait;

    protected $guarded = [];

    protected $casts = [
        'venue' => 'array',
        'teams' => 'array',
        'home_lines' => 'array',
        'away_lines' => 'array',
        'notes' => 'array',
        'situation' => 'array',
        'leaders' => 'array',
        'broadcasts' => 'array',
        'home_records' => 'array',
        'away_records' => 'array'
    ];

    protected $with = [
        'homeTeam',
        'homeConference',
        'awayTeam',
        'awayConference',
        'favorite'
    ];

    public function getTimeAttribute()
    {
        return Carbon::parse($this->start_date)
            ->setTimezone(Session::get('geo.timezone', 'America/New_York'))
            ->format('g:i A');
    }
}
