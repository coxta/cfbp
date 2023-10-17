<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FeedLog extends Model
{
    use HasUuids;

    protected $fillable = [
        'feed_id',
        'job_id',
        'started_at',
        'completed_at',
        'disposition',
        'exception'
    ];

    public function getDurationAttribute()
    {
        $start = Carbon::parse($this->started_at);

        $end_date = $this->completed_at ?? now();
        $end = Carbon::parse($end_date);

        $seconds = $end->diffInSeconds($start);
        $minutes = $end->diffInMinutes($start);

        if($minutes >= 1) {
            $seconds = $seconds - ($minutes * 60);
            return $minutes . 'm ' . $seconds . 's';
        } else {
            return $seconds . 's';
        }

    }

}