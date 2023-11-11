<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasRecordTypes;
use App\Models\Traits\ContestTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CascadeSoftDeletes;

class Contest extends Model
{

    use HasUuids, HasRecordTypes, SoftDeletes, CascadeSoftDeletes, ContestTrait;

    protected $fillable = [
        'group_id',
        'week_id',
        'type_id',
        'name',
        'status'
    ];

    protected $with = [
        'group',
        'week',
        'selections'
    ];

}
