<?php

namespace Whitecube\LaravelCookieConsent;

use Illuminate\Support\Facades\Config;

class EssentialCookiesCategory extends CookiesCategory
{
    /**
     * Define the package's consent cookie
     */
    public function consent(): static
    {
        return $this->cookie(function(Cookie $cookie) {
            $cookie->name(Config::get('cookieconsent.cookie.name'))
                ->duration(Config::get('cookieconsent.cookie.duration'))
                ->description(__('cookieConsent::cookies.defaults.consent'));
        });
    }

    /**
     * Define Laravel's session cookie.
     */
    public function session(): static
    {
        return $this->cookie(function(Cookie $cookie) {
            $cookie->name(Config::get('session.cookie'))
                ->duration(Config::get('session.lifetime'))
                ->description(__('cookieConsent::cookies.defaults.session'));
        });
    }

    /**
     * Define Laravel's XSRF-TOKEN cookie.
     */
    public function csrf(): static
    {
        return $this->cookie(function(Cookie $cookie) {
            $cookie->name('XSRF-TOKEN')
                ->duration(Config::get('session.lifetime'))
                ->description(__('cookieConsent::cookies.defaults.csrf'));
        });
    }
}
