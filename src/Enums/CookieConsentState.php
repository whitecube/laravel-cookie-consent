<?php

namespace Whitecube\LaravelCookieConsent\Enums;

enum CookieConsentState
{
    // User has yet to configure consent
    case Pending;

    // User has defined a consent configuration
    case Configured;

    // User has configured consent but wants to show the modal in order to eventually make changes
    // case Updating; TODO: Add for Pull Request 103

    // User had configured consent but chose to reset the settings (similar to "pending")
    case Reset;

    public function shouldDisplayNotice(): bool
    {
        return match($this) {
            static::Pending , static::Reset=> true,
            static::Configured => false,
//            static::Updating => true,
        };
    }
}