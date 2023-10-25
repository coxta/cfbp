<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    use HasUuids;

    protected $fillable = [
        'contest_id',
        'game_id',
        'favorite_id',
        'spread',
        'points'
    ];
}
