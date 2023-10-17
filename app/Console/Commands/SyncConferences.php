<?php

namespace App\Console\Commands;

use App\Jobs\Feeds\Conferences;
use Illuminate\Console\Command;

class SyncConferences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:conferences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch Feeds\Conferences job';

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
        Conferences::dispatch();
    }
}