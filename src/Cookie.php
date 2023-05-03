<?php

namespace Whitecube\LaravelCookieConsent;

use Closure;

class Cookie
{
    use Concerns\HasAttributes;

    /**
     * The cookie's name.
     */
    public readonly string $name;

    /**
     * The cookie's duration.
     */
    public readonly int $duration;

    /**
     * The cookie's duration.
     */
    protected ?Closure $script = null;

    /**
     * Set the cookie's name.
     */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the cookie's duration in seconds.
     */
    public function duration(int $seconds): static
    {
        $this->duration = $seconds;

        return $this;
    }

    /**
     * Set the cookie's consent callback.
     */
    public function script(Closure $callback): static
    {
        $this->script = $callback;

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
