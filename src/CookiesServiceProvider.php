<?php

namespace Whitecube\LaravelCookieConsent;

use Illuminate\Cookie\Middleware\EncryptCookies;
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
        $this->app->afterResolving(EncryptCookies::class, function (EncryptCookies $middleware) {
            $middleware->disableFor(config('cookieconsent.cookie.name'));
        });
    }
}