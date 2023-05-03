<?php

namespace Whitecube\LaravelCookieConsent;

use Illuminate\Support\Facades\Config;

class OperationalCookiesCategory extends CookiesCategory
{
    /**
     * Define Laravel's session cookie.
     */
    public function session(): static
    {
        return $this->cookie(function(Cookie $cookie) {
            $cookie->name(Config::get('session.cookie'))
                ->duration(Config::get('session.lifetime'));
        });
    }

    /**
     * Define Laravel's XSRF-TOKEN cookie.
     */
    public function csrf(): static
    {
        return $this->cookie(function(Cookie $cookie) {
            $cookie->name('XSRF-TOKEN')
                ->duration(Config::get('session.lifetime'));
        });
    }
}
