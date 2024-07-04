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


    public function durationInHumanReadableFormat(): string
    {
        $duration = $this->duration;

        $years = floor($duration / 525600); // 1 year = 525600 minutes
        $duration %= 525600;

        $days = floor($duration / 1440); // 1 day = 1440 minutes
        $duration %= 1440;

        $hours = floor($duration / 60); // 1 hour = 60 minutes

        $minutes = $duration % 60;

        $result = [];

        if ($years > 0) {
            $result[] = "$years ". trans_choice('cookieConsent::cookies.year', $years);
        }

        if ($days > 0) {
            $result[] = "$days ". trans_choice('cookieConsent::cookies.day', $days);
        }

        if ($hours > 0) {
            $result[] = "$hours ". trans_choice('cookieConsent::cookies.hour', $hours);
        }

        if ($minutes > 0 || empty($result)) {
            $result[] = "$minutes ". trans_choice('cookieConsent::cookies.minute', $minutes);
        }

        return implode(", ", $result);
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
