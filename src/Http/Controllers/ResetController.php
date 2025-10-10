<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class ResetController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $exclude = ['XSRF-TOKEN', 'laravel-session'];

        $keys = array_filter(
            array_keys($request->cookies->all()),
            fn($key) => !in_array($key, $exclude, true)
        );

        $response = !$request->expectsJson()
            ? redirect()->back()
            : response()->json([
                'status' => 'ok',
                'scripts' => $cookies->getNoticeScripts(true),
                'notice' => $cookies->getNoticeMarkup(),
            ]);

        foreach ($keys as $key) {
            $response->withoutCookie(
                cookie: $key,
                domain: config('cookieconsent.cookie.domain'),
            );
        }

        return $response;
    }
}
