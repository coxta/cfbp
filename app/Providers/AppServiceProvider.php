<?php

namespace App\Providers;

use App\Models\FeedLog;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\FeedController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Queue::failing(function ($event) {

            if($log = FeedLog::where('job_id', $event->job->payload()['uuid'])->first()) {
                FeedController::failed($log, $event->exception);
            }

        });

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->admin;
        });
    }
}
