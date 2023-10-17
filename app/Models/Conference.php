<?php

namespace App\Models;

use App\Models\Traits\ConferenceTrait;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{

    use ConferenceTrait;

    protected $guarded = [];

}