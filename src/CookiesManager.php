<?php

namespace Whitecube\LaravelCookieConsent;

class CookiesManager
{
    /**
     * The cookies registrar.
     */
    protected CookiesRegistrar $registrar;

    /**
     * Create a new Service Manager instance.
     */
    public function __construct(CookiesRegistrar $registrar)
    {
        $this->registrar = $registrar;
    }

    /**
     * Transfer all undefined method calls to the registrar.
     */
    public function __call(string $method, array $arguments)
    {
        return $this->registrar->$method(...$arguments);
    }
}
