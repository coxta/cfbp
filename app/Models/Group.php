<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GroupTrait;
use App\Models\Traits\HasRecordTypes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CascadeSoftDeletes;

class Group extends Model
{
    use HasUuids, GroupTrait, HasRecordTypes, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = [
        'members'
    ];

    protected $fillable = [
        'name',
        'type_id',
        'user_id',
        'options'
    ];

    protected $casts = [
        'options' => 'array',
    ];

}
