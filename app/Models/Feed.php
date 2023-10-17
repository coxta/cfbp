<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use App\Models\Traits\FeedTrait;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use Uuid, FeedTrait;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'job',
        'frequency'
    ];

}