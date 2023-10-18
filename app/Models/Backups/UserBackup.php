<?php

namespace App\Models\Backups;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserBackup extends Model
{
    
    use HasUuids;

    protected $table = 'users_bak';

    protected $guarded = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'teams' => 'array'
    ];

    public function isAdmin()
    {
        return $this->admin;
    }

}
