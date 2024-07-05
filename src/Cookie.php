<?php

namespace Whitecube\LaravelCookieConsent;

class Cookie
{
    use Concerns\HasAttributes;
    use Concerns\HasConsentCallback;

    /**
     * The cookie's name.
     */
    public readonly string $name;

    /**
     * The cookie's duration.
     */
    public readonly int $duration;

    /**
     * Set the cookie's name.
     */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the cookie's duration in minutes.
     */
    public function duration(int $minutes): static
    {
        $this->duration = $minutes;

        return $this;
    }

    /**
     * Set an attribute dynamically.
     */
    public function __call(string $method, array $arguments): static
    {
        $this->setAttribute($method, $arguments[0] ?? null);

        return $this;
    }
}
