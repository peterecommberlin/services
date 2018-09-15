<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



use Illuminate\Support\Facades\View;
use Eventjuicer\ViewComposers\ParticipantPromoComposer;
use Horizon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('promo/*', ParticipantPromoComposer::class);
        View::composer('crm/*', ParticipantPromoComposer::class);

        if($this->app->environment() === 'production')
        { 
            $this->app['request']->server->set('HTTPS', true); 
        }

        Horizon::auth(function ($request) {
            return true;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    




    }
}
