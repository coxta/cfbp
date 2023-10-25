<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasUuids;

    protected $fillable = [
        'group_id',
        'week_id',
        'type_id',
    ];
}
