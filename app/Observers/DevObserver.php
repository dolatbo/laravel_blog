<?php

namespace App\Observers;

use App\Http\Models\Devs;
use App\Http\Models\Posts;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmailDevs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DevObserver
{
    /**
     * Handle the devs "created" event.
     *
     * @param  App\Http\Models\Devs  $devs
     * @return void
     */
    public function created(Devs $devs)
    {
        $user = Auth::user();
        //        Log::alert('create by' . $user->id . '-' . $user->name . ' -> ' . $devs->toJson());
        Log::alert("create by {$user->id} - {$user->name} -> {$devs->toJson()}");

        $infs = [];
        $infs['email'] = 'douglas@datamais.com.br';

        SendEmailJob::dispatch($devs->toArray(), $infs);

        // $sendMail = new SendEmailDevs($devs->toArray());
        // Mail::to($infs['email'])->send($sendMail);
    }

    public function creating(Devs $devs)
    {
        Log::alert('creating' . $devs->toJson());
    }

    /**
     * Handle the devs "updated" event.
     *
     * @param  App\Http\Models\Devs  $devs
     * @return void
     */
    public function updated(Devs $devs)
    {
        Log::alert('updated' . $devs->toJson());
    }

    public function updating(Devs $devs)
    {
        Log::alert('updated' . $devs->toJson());
    }

    /**
     * Handle the devs "deleted" event.
     *
     * @param  App\Http\Models\Devs  $devs
     * @return void
     */
    public function deleting(Devs $devs)
    {
        Posts::where('dev_id', $devs->id)->delete();
        $devs->techs()->detach();
        Log::alert('deleting' . $devs->toJson());
    }

    public function deleted(Devs $devs)
    {
        Log::alert('deleted' . $devs->toJson());
    }

    /**
     * Handle the devs "restored" event.
     *
     * @param  App\Http\Models\Devs  $devs
     * @return void
     */
    public function restored(Devs $devs)
    {
        //
    }

    /**
     * Handle the devs "force deleted" event.
     *
     * @param  App\Http\Models\Devs  $devs
     * @return void
     */
    public function forceDeleted(Devs $devs)
    {
        //
    }
}
