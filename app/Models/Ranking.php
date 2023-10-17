<?php

namespace App\Models;

use App\Models\Traits\RankingTrait;
use App\Models\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use Uuid, RankingTrait;

    protected $guarded = [];

    protected $with = [
        'team'
    ];
}