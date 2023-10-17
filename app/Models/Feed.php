<?php

namespace App\Models;

use App\Models\Traits\FeedTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasUuids, FeedTrait;

    protected $fillable = [
        'name',
        'description',
        'job',
        'frequency'
    ];

}