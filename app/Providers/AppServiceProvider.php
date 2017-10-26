<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Response::macro('downloadViewAsHtml', function ($content) {

            $headers = [
             'Content-type'        => 'text/html',
             'Content-Disposition' => 'attachment; filename="newsletter_'.date("YmdHi").'.html"',
            ];

            return \Response::make($content, 200, $headers);

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
