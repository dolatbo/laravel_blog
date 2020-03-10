<?php

namespace App\Observers;

use App\Http\Models\Pivot\DevsTechs;

class DevsTechsObserver
{
    /**
     * Handle the devs techs "created" event.
     *
     * @param  \App\Http\Models\Pivot\DevsTechs  $devsTechs
     * @return void
     */
    public function created(DevsTechs $devsTechs)
    {
        //
    }

    /**
     * Handle the devs techs "updated" event.
     *
     * @param  \App\Http\Models\Pivot\DevsTechs  $devsTechs
     * @return void
     */
    public function updated(DevsTechs $devsTechs)
    {
        //
    }

    /**
     * Handle the devs techs "deleted" event.
     *
     * @param  \App\Http\Models\Pivot\DevsTechs  $devsTechs
     * @return void
     */
    public function deleted(DevsTechs $devsTechs)
    {
        //
    }

    /**
     * Handle the devs techs "restored" event.
     *
     * @param  \App\Http\Models\Pivot\DevsTechs  $devsTechs
     * @return void
     */
    public function restored(DevsTechs $devsTechs)
    {
        //
    }

    /**
     * Handle the devs techs "force deleted" event.
     *
     * @param  \App\Http\Models\Pivot\DevsTechs  $devsTechs
     * @return void
     */
    public function forceDeleted(DevsTechs $devsTechs)
    {
        //
    }
}
