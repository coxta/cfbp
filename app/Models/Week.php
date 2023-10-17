<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use App\Models\Traits\WeekTrait;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use Uuid, WeekTrait;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

}