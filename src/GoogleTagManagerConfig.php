<?php

namespace Whitecube\LaravelCookieConsent;

class GoogleTagManagerConfig
{
    protected static bool $enabled = false;
    protected static array $config = [];

    public static function enable(array $config): void
    {
        static::$enabled = true;
        static::$config = $config;
    }

    public static function isEnabled(): bool
    {
        return static::$enabled;
    }

    public static function getConfig(): array
    {
        return static::$config;
    }

    public static function reset(): void
    {
        static::$enabled = false;
        static::$config = [];
    }
}