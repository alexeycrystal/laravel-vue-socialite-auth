<?php

namespace App\Providers;

use App\Services\LoginService;
use App\Services\RegisterService;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->singleton('App\Services\LoginService', function(Application $app){
            return new LoginService();
        });
        $this->app->bind(
            'App\Services\Contracts\LoginServiceInterface',
            'App\Services\LoginService'
        );

        $this->app->singleton('App\Services\RegisterService', function(Application $app){
            return new RegisterService();
        });
        $this->app->bind(
            'App\Services\Contracts\RegisterServiceInterface',
            'App\Services\RegisterService'
        );
    }
}
