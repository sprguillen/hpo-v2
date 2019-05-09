<?php

namespace App\Observers;

use App\Models\Batch;

class BatchObserver
{
    /**
     * Handle the batch "created" event.
     *
     * @param  \App\Batch  $batch
     * @return void
     */
    public function created(Batch $batch)
    {
        $batch->code = int_to_code($batch->id);
    }

    /**
     * Handle the batch "updated" event.
     *
     * @param  \App\Batch  $batch
     * @return void
     */
    public function updated(Batch $batch)
    {
        //
    }

    /**
     * Handle the batch "deleted" event.
     *
     * @param  \App\Batch  $batch
     * @return void
     */
    public function deleted(Batch $batch)
    {
        //
    }

    /**
     * Handle the batch "restored" event.
     *
     * @param  \App\Batch  $batch
     * @return void
     */
    public function restored(Batch $batch)
    {
        //
    }

    /**
     * Handle the batch "force deleted" event.
     *
     * @param  \App\Batch  $batch
     * @return void
     */
    public function forceDeleted(Batch $batch)
    {
        //
    }
}
