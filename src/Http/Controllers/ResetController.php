<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;
use Whitecube\LaravelCookieConsent\Enums\CookieConsentState;

class ResetController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $cookies->setCookieConsentState(CookieConsentState::Reset);

        $response = ! $request->expectsJson()
            ? redirect()->back()
            : response()->json([
                'status' => 'ok',
                'scripts' => $cookies->getNoticeScripts(true),
                'notice' => $cookies->getNoticeMarkup(),
            ]);

        return $response->withoutCookie(
            cookie: config('cookieconsent.cookie.name'),
            domain: config('cookieconsent.cookie.domain'),
        );
    }
}
