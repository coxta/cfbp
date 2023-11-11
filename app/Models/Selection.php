<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CascadeSoftDeletes;
use App\Models\Traits\SelectionTrait;

class Selection extends Model
{
    use HasUuids, SoftDeletes, CascadeSoftDeletes, SelectionTrait;

    protected $fillable = [
        'contest_id',
        'game_id',
        'favorite_id',
        'spread',
        'points'
    ];

    protected $with = [
        'game',
        'favorite'
    ];
    
}
