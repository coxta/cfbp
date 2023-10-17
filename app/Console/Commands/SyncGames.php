<?php

namespace App\Console\Commands;

use App\Jobs\Feeds\Games;
use Illuminate\Console\Command;

class SyncGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Games Feed Sync';

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
        Games::dispatch();
    }
}