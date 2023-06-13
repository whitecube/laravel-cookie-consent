<?php

namespace Whitecube\LaravelCookieConsent\Concerns;

trait HasTranslations
{
    /**
     * Get a translation string when defined.
     */
    public function translate(string $key, ?string $default = null): ?string
    {
        $key = 'cookieConsent::cookies.' . $key;
        $value = app('translator')->get($key);

        return ($value === $key)
            ? $default
            : $value;
    }
}
