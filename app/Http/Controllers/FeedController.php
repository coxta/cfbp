<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\FeedLog;

class FeedController extends Controller
{
    public function run($feed)
    {
        $job = Feed::find($feed)->job;

        $job_id = call_user_func( array( $job, 'dispatch' ) );
    }

    public static function queued($feed)
    {

        $feed_id = Feed::select('id')->where('job', 'App\Jobs\Feeds\\' . $feed)->first()->id;

        $log = FeedLog::create([
            'feed_id' => $feed_id,
            'disposition' => 'Queued'
        ]);

        return $log;

    }

    public static function running($log, $job)
    {
        $log->job_id = $job;
        $log->started_at = now();
        $log->disposition = 'Running';
        $log->save();
    }

    public static function finished($log)
    {
        $log->completed_at = now();
        $log->disposition = 'Complete';
        $log->save();
    }

    public static function failed($log, $exception)
    {
        $log->completed_at = now();
        $log->disposition = 'Failed';
        $log->exception = $exception->getMessage() . ' (Line ' . $exception->getLine() . ')';
        $log->save();
    }
}