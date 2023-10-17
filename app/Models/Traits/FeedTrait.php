<?php

namespace App\Models\Traits;

use App\Models\FeedLog;

trait FeedTrait
{

    public function logs()
    {
        return $this->hasMany(FeedLog::class);
    }
}