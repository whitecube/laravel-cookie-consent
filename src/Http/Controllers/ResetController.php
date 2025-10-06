<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Illuminate\Support\Facades\Cookie as CookieFacade;
use Whitecube\LaravelCookieConsent\ConsentResponse;
use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class ResetController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {

        $categories = $cookies->getCategories();

        $currentPreferences = $cookies->preferences ?? [];

        $cookiesData = [
            'consent_at' => $currentPreferences['consent_at'] ?? time(),
            'categories' => [],
        ];

        foreach ($categories as $category) {
            $cookieNames = collect($category->getCookies())->pluck('name');

            $allAccepted = $cookieNames->every(fn($name) => !empty($currentPreferences[$name]));

            $cookiesData['categories'][$category->key()] = $allAccepted;
        }

        $cookie = CookieFacade::make(
            name: config('cookieconsent.cookie.name'),
            value: json_encode($cookiesData),
            minutes: 0,
            domain: config('cookieconsent.cookie.domain'),
            secure: (config('app.env') == 'local') ? false : true
        );

        $response = $request->expectsJson()
            ? response()->json([
                'status' => 'updated',
                'preferences' => $cookiesData,
            ])
            : redirect()->back();

        return $response->withCookie($cookie);
    }
}
