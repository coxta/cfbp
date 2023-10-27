<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CascadeSoftDeletes;

use App\Models\Traits\UserTrait;

/**
 * Add this back when ready
 * 
 * class User extends Authenticatable implements MustVerifyEmail
 */
class User extends Authenticatable
{

    use HasUuids, Notifiable, UserTrait, SoftDeletes, CascadeSoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'teams' => 'array'
    ];

}