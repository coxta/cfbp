<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GroupTrait;

class Group extends Model
{
    use HasUuids, GroupTrait;

    protected $fillable = [
        'name',
        'type_id',
        'user_id'
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
