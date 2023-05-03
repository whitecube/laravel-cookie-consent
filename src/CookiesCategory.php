<?php

namespace Whitecube\LaravelCookieConsent;

class CookiesCategory
{
    use Concerns\HasAttributes;

    /**
     * The category's identifier.
     */
    protected string $key;

    /**
     * The registered cookies.
     */
    protected array $cookies = [];

    /**
     * Create a new cookies category container instance.
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * Get this category's identifier.
     */
    public function key(): string
    {
        return $this->key;
    }

    /**
     * Return all defined cookies.
     */
    public function getCookies(): array
    {
        return array_values($this->cookies);
    }

    /**
     * Create a new cookies category container instance.
     */
    public function register(Cookie $instance): static
    {
        $this->cookies[] = $instance;

        return $this;
    }

    /**
     * Configure a new cookie by calling one of its setting methods.
     */
    public function __call(string $method, array $arguments): Cookie
    {
        $instance = new Cookie();
        $instance->$method(...$arguments);

        $this->register($instance);

        return $instance;
    }
}
