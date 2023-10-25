<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RecordType extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'model',
        'description'
    ];
}
