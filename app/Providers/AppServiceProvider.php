<?php

namespace App\Providers;

use App\Http\Models\Devs;
use App\Http\Models\Pivot\DevsTechs;
use App\Observers\DevObserver;
use App\Observers\DevsTechsObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        Devs::observe(DevObserver::class);
        DevsTechs::observe(DevsTechsObserver::class);
    }
}
