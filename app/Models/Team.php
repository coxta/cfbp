<?php

namespace App\Models;

use App\Models\Traits\TeamTrait;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    use TeamTrait;

    protected $guarded = [];

    protected $with = [
        'conference',
    ];

    protected $casts = [
        'stats' => 'array',
    ];

}