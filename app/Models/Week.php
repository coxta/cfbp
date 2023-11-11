<?php

namespace App\Models;

use App\Models\Traits\WeekTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{

    use HasUuids, WeekTrait;

    protected $guarded = [];

    protected $with = [
        'calendar'
    ];
    
}