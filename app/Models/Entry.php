<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasUuids;

    protected $fillable = [
        'contest_id',
        'member_id',
        'name',
        'tiebreaker'
    ];
}