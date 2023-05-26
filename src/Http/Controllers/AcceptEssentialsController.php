<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class AcceptEssentialsController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        // TODO.
        
        return redirect()->back();
    }
}
