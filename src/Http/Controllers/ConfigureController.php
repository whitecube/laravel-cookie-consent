<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class ConfigureController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $categories = $request->collect()
            ->filter(function($value, $key) use ($cookies) {
                return $cookies->hasCategory($key) && filter_var($value, FILTER_VALIDATE_BOOLEAN);
            })
            ->keys()
            ->all();

        $consent = $cookies->accept($categories);

        return $request->expectsJson()
            ? response()->json(['status' => 'ok'])->withCookie($consent)
            : redirect()->back()->withCookie($consent);
    }
}
