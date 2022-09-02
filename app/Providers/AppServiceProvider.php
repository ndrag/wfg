<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        # Force HTTPS for all calls to assets and external links. Shouldn't strictly be necessary if app environment is set to 'production', but this is a quick win solution! 
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
