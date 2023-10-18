<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Feed;
use App\Models\FeedLog;
use App\Models\Backups\FeedBackup;

use App\Models\User;
use App\Models\Backups\UserBackup;

use App\Jobs\Feeds\Calendars;
use App\Jobs\Feeds\Conferences;
use App\Jobs\Feeds\Teams;
use App\Jobs\Feeds\Rankings;
use App\Jobs\Feeds\SeasonSchedule;
use App\Jobs\Feeds\Games;
use App\Jobs\Feeds\News;

class Remigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remigrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets all migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        // if(config('app.env') == 'production') return;

        /**
         * Backup Feeds
         */
        Schema::dropIfExists('feeds_bak');
        Schema::create('feeds_bak', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 50);
            $table->string('description', 150);
            $table->string('job', 100);
            $table->string('frequency', 50);
            $table->timestamps();
        });
        
        foreach (Feed::get() as $feed) {
            FeedBackup::create($feed->toArray());
        }

        /**
         * Backup Users
         */
        Schema::dropIfExists('users_bak');
        Schema::create('users_bak', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('admin')->default(false);
            $table->json('teams')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        foreach (User::get()->makeVisible(['password', 'remember_token']) as $user) {
            UserBackup::create($user->toArray());
        }
        
        /**
         * Rollback and re-run the migrations
         */
        $this->call('migrate:reset');
        $this->call('migrate');
        
        /**
         * Restore Users
         */
        foreach (UserBackup::get() as $restoreUser) {
            User::create($restoreUser->toArray());
        }

        /**
         * Restore Feeds
         */
        foreach (FeedBackup::get() as $restoreFeed) {
            Feed::create($restoreFeed->toArray());
        }

        /**
         * Purge the Feed Logs
         */
        FeedLog::truncate();

        /**
         * Dispatch Core Jobs
         */
        Calendars::dispatch();
        Conferences::dispatch();
        Teams::dispatch();
        Rankings::dispatch();
        SeasonSchedule::dispatch();
        Games::dispatch();
        News::dispatch();

        /**
         * If local, queue a worker
         */
        if(config('app.env') == 'local') $this->call('queue:work');

    }
}
