<?php

namespace Whitecube\LaravelCookieConsent;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Make the cookies register class
        $this->app->singleton(CookiesRegistrar::class, function () {
            return new CookiesRegistrar();
        });
    }
}