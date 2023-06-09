<?php

namespace Whitecube\LaravelCookieConsent\Concerns;

use Closure;
use Whitecube\LaravelCookieConsent\Cookie;
use Whitecube\LaravelCookieConsent\CookiesGroup;

trait HasCookies
{
    /**
     * The registered cookies.
     */
    protected array $cookies = [];

    /**
     * Return all the defined cookies as a flat array.
     */
    public function getCookies(): array
    {
        return array_reduce($this->cookies, function($cookies, $item) {
            if(is_a($item, CookiesGroup::class)) {
                $cookies = array_merge($cookies, $item->getCookies());
            } else {
                $cookies[] = $item;
            }
            return $cookies;
        }, []);
    }

    /**
     * Return all the raw defined items.
     */
    public function getDefined(): array
    {
        return $this->cookies;
    }

    /**
     * Add a single cookie to this collection.
     */
    public function cookie(Closure|Cookie $cookie): static
    {
        if(is_a($cookie, Closure::class)) {
            $instance = new Cookie();
            $cookie($instance);
        } else {
            $instance = $cookie;
        }

        return $this->register($instance);
    }

    /**
     * Push a cookie instance or group to this collection.
     */
    protected function register(Cookie|CookiesGroup $instance): static
    {
        $this->cookies[] = $instance;

        return $this;
    }
}
