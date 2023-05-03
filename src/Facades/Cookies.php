<?php

namespace Whitecube\LaravelCookieConsent\Facades;

use Illuminate\Support\Facades\Facade;

class Cookies extends Facade
{
    public static function getFacadeAccessor()
    {
        return \Whitecube\LaravelCookieConsent\CookiesManager::class;
    }
}
