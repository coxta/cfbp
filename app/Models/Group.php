<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'type_id',
        'user_id'
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
