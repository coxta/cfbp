<?php

namespace App\Models;

use App\Models\Traits\RankingTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{

    use HasUuids, RankingTrait;

    protected $guarded = [];

    protected $with = [
        'team'
    ];
    
}