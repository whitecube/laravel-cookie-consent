<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Whitecube\LaravelCookieConsent\CookiesManager;
use Whitecube\LaravelCookieConsent\Facades\Cookies;


class ResetController {

    public function __invoke(Request $request, CookiesManager $cookies) {
        $response = !$request->expectsJson()
            ? redirect()->back()
            : response()->json([
                'status' => 'ok',
                'scripts' => $cookies->getNoticeScripts(true),
                'notice' => $cookies->getNoticeMarkup(),
            ]);

        $domain = config('cookieconsent.cookie.domain');

        // delete all defined cookies
        foreach (Cookies::getCategories() as $category) {
            foreach ($category->getCookies() as $cookie) {
                Cookie::queue(Cookie::forget(
                    name: $cookie->name,
                    domain: $domain,
                ));
            }
        }

        return $response->withoutCookie(
            cookie: config('cookieconsent.cookie.name'),
            domain: config('cookieconsent.cookie.domain'),
        );
    }
}
