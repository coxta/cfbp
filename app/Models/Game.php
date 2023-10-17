<?php

namespace App\Models;

use App\Models\Traits\GameTrait;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use GameTrait;

    protected $guarded= [];

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

}