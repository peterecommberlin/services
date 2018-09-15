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

        //use NGINX cookie-based auth!

        Horizon::auth(function ($request) {
            return true;
        });

        Horizon::routeSlackNotificationsTo(env("QUEUE_SLACK_URL"), '#dev');

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
