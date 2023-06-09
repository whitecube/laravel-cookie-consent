<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class AcceptAllController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        return $cookies->accept('*')->toResponse($request);
    }
}
