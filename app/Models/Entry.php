<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CascadeSoftDeletes;

class Entry extends Model
{
    use HasUuids, SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'contest_id',
        'member_id',
        'name',
        'tiebreaker'
    ];
}