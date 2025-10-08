<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Illuminate\Support\Facades\Cookie as CookieFacade;
use Symfony\Component\HttpFoundation\Cookie;
use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class EditController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $cookieData = $this->getEditCookieData($cookies);

        $editCookie = $this->getEditCookie($cookieData);

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

    protected function getEditCookieData(CookiesManager $cookies) : array
    {
        $categories = $cookies->getCategories();

        $currentPreferences = $cookies->preferences ?? [];

        $cookiesData = [];

        foreach ($categories as $category) {
            $cookieNames = collect($category->getCookies())->pluck('name');

            $allAccepted = $cookieNames->every(fn($name) => !empty($currentPreferences[$name]));

            $cookiesData[$category->key()] = $allAccepted;
        }

        return $cookiesData;
    }

    protected function getEditCookie(array $cookieData): Cookie
    {
        return CookieFacade::make(
            name: 'edit-cookie',
            value: json_encode($cookieData),
            minutes: 0,
            domain: config('cookieconsent.cookie.domain'),
            secure: (config('app.env') == 'local') ? false : true
        );
    }
}
