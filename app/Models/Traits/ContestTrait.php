<?php

namespace App\Models\Traits;

use App\Models\Group;
use App\Models\Week;
use App\Models\Selection;

trait ContestTrait
{

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function week()
    {
        return $this->belongsTo(Week::class);
    }

    public function selections()
    {
        return $this->hasMany(Selection::class);
    }

}