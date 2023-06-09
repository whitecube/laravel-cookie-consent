<?php

namespace Whitecube\LaravelCookieConsent\Concerns;

use Closure;
use Whitecube\LaravelCookieConsent\Consent;

trait HasConsentCallback
{
    /**
     * The callback that should be called when consent is given.
     */
    protected ?Closure $callback = null;

    /**
     * Set the cookie's consent callback.
     */
    public function accepted(Closure $callback): static
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * Check if there is a defined consent callback.
     */
    public function hasConsentCallback(): bool
    {
        return ! is_null($this->callback);
    }

    /**
     * Check if there is a defined consent callback.
     */
    public function getConsentResult(): Consent
    {
        $consent = new Consent($this);

        call_user_func($this->callback, $consent);

        return $consent;
    }
}
