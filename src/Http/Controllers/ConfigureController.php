<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class ConfigureController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $categories = collect($request->get('categories', []))
            ->prepend('essentials')
            ->unique()
            ->filter(fn($key) => $cookies->hasCategory($key))
            ->values()
            ->all();

        return $cookies->accept($categories)->toResponse($request);
    }
}
