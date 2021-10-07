<?php

namespace App\Observers;

use App\Models\Round;

class RoundObserver
{
    /**
     * Handle the Round "created" event.
     *
     * @param  \App\Models\Round  $round
     * @return void
     */
    public function created(Round $round)
    {
        //
    }

    /**
     * Handle the Round "updated" event.
     *
     * @param  \App\Models\Round  $round
     * @return void
     */
    public function updated(Round $round)
    {
        //
    }

    /**
     * Handle the Round "deleted" event.
     *
     * @param  \App\Models\Round  $round
     * @return void
     */
    public function deleted(Round $round)
    {
        //
    }

    /**
     * Handle the Round "restored" event.
     *
     * @param  \App\Models\Round  $round
     * @return void
     */
    public function restored(Round $round)
    {
        //
    }

    /**
     * Handle the Round "force deleted" event.
     *
     * @param  \App\Models\Round  $round
     * @return void
     */
    public function forceDeleted(Round $round)
    {
        //
    }
}
