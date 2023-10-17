<?php

namespace App\Console\Commands;

use App\Jobs\Feeds\Calendars;
use Illuminate\Console\Command;

class SyncCalendars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:calendars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch Feeds\Calendars job';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Calendars::dispatch();
    }
}