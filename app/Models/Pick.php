<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CascadeSoftDeletes;

class Pick extends Model
{
    use HasUuids, SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'entry_id',
        'selection_id',
        'pick',
    ];
}