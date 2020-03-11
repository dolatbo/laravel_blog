<?php

namespace App\Observers;

use App\Http\Models\Pivot\DevsTechs;
use Illuminate\Support\Facades\Log;

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
        Log::alert('created' . $devsTechs->toJson());
    }

    /**
     * Handle the devs techs "updated" event.
     *
     * @param  \App\Http\Models\Pivot\DevsTechs  $devsTechs
     * @return void
     */
    public function updated(DevsTechs $devsTechs)
    {
        Log::alert('updated' . $devsTechs->toJson());
    }

    /**
     * Handle the devs techs "deleted" event.
     *
     * @param  \App\Http\Models\Pivot\DevsTechs  $devsTechs
     * @return void
     */
    public function deleted(DevsTechs $devsTechs)
    {
        Log::alert('deleted' . $devsTechs->toJson());
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
