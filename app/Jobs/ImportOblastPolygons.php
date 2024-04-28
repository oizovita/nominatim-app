<?php

namespace App\Jobs;

use App\Services\Oblast\ImportPolygonsFromNominatim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportOblastPolygons implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ImportPolygonsFromNominatim $importPolygonsFromNominatim;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(ImportPolygonsFromNominatim $importPolygonsFromNominatim): void
    {
        $importPolygonsFromNominatim->run();
    }

}
