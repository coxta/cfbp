<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pick extends Model
{
    use HasUuids;

    protected $fillable = [
        'entry_id',
        'selection_id',
        'pick',
    ];
}