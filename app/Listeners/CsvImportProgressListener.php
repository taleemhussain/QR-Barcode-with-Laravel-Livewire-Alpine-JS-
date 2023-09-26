<?php

namespace App\Listeners;
use App\Events\CsvImportProgress;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CsvImportProgressListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CsvImportProgress $event)
    {
        $percentage = $event->percentage;
        $recordsInserted = $event->recordsInserted;
       // You can now use $percentage and $recordsInserted in your listener logic.
    }
}
