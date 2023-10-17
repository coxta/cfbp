<?php

namespace App\Models;

use App\Models\Traits\DivisionTrait;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{

    use DivisionTrait;

    protected $guarded = [];
}