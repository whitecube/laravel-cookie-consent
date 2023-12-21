<?php

namespace Whitecube\LaravelCookieConsent;

use Illuminate\Support\ServiceProvider;

abstract class CookiesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->booted(function () {
            $this->registerCookies();
        });
    }

    /**
     * Define the cookies users should be aware of.
     */
    abstract protected function registerCookies(): void;

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }
}