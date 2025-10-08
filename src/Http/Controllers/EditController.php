<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Illuminate\Support\Facades\Cookie as CookieFacade;
use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class EditController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $editCookie = CookieFacade::make(
            name: 'edit-cookie',
            value: json_encode(true),
            minutes: 0,
            domain: config('cookieconsent.cookie.domain'),
            secure: (config('app.env') == 'local') ? false : true
        );

        $response = ! $request->expectsJson()
            ? redirect()->back()
            : response()->json([
            'status' => 'ok',
            'scripts' => $cookies->getNoticeScripts(true),
            'notice' => $cookies->getNoticeMarkup(),
        ]);

        return $response->withCookie(
            $editCookie
        );
    }
}
