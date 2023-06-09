<?php

namespace Whitecube\LaravelCookieConsent;

class CookiesGroup
{
    use Concerns\HasCookies;
    use Concerns\HasConsentCallback;

    /**
     * The group's name.
     */
    public readonly string $name;

    /**
     * Set the group's name.
     */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
