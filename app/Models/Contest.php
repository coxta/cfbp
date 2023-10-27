<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasRecordTypes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CascadeSoftDeletes;

class Contest extends Model
{
    use HasUuids, HasRecordTypes, SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'group_id',
        'week_id',
        'type_id',
    ];
}
