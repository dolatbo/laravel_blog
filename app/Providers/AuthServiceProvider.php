<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        // Invalidar token apos um tempo
        // ex.: now() // ou seja o momento que a pessoa executou o login
        // addGRANDEZA_DE_TEMPO(QUANTIDADE)
        Passport::personalAccessTokensExpireIn(now()->addMinutes(5));

        //
    }
}
