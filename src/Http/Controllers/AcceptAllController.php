<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class AcceptAllController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        // TODO.
        
        $consent = cookie(config('cookieconsent.cookie.name'), json_encode(['test' => true, 'foo' => false]), config('cookieconsent.cookie.duration'));

        if(! is_null($domain = config('cookieconsent.cookie.domain'))) {
            $consent = $consent->withDomain($domain);
        }

        return redirect()->back()->withCookie($consent);
    }
}
