<?php

namespace App\Console\Commands;

use App\Jobs\ImportOblastPolygons;
use Illuminate\Console\Command;

class SyncOblastPolygons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:import-oblast-polygons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ImportOblastPolygons::dispatchSync();
    }
}
