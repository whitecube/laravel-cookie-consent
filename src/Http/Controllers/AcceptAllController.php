<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;
use Whitecube\LaravelCookieConsent\Enums\CookieConsentState;

class AcceptAllController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        return $cookies->setCookieConsentState(CookieConsentState::Configured)->accept('*')->toResponse($request);
    }
}
