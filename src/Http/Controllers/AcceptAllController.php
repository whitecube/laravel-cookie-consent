<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class AcceptAllController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $consent = $cookies->accept('*');

        return $request->expectsJson()
            ? response()->json(['status' => 'ok'])->withCookie($consent)
            : redirect()->back()->withCookie($consent);
    }
}
