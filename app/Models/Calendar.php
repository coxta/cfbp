<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use App\Models\Traits\CalendarTrait;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{

    use Uuid, CalendarTrait;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

}