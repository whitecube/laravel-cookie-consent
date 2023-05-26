<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class AcceptAllController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        // TODO.
        
        $consent = cookie('laravel-cookie-consent', json_encode(['test' => true, 'foo' => false]), (60 * 24 * 365));

        return redirect()->back()->withCookie($consent);
    }
}
