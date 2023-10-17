<?php

namespace App\Models;

use App\Models\Traits\CalendarTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{

    use HasUuids, CalendarTrait;

    protected $guarded = [];
    
}