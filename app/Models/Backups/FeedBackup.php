<?php

namespace App\Models\Backups;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FeedBackup extends Model
{
    use HasUuids;
    protected $table = 'feeds_bak';
    protected $guarded = [];
}
