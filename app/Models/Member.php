<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasUuids;

    protected $fillable = [
        'group_id',
        'type_id',
        'user_id'
    ];

}
