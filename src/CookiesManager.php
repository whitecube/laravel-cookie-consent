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

    /**
     * Output all the scripts for current consent state.
     */
    public function renderScripts(bool $withDefault = true): string
    {
        $output = '';

        if($withDefault) {
            $output .= $this->getDefaultScriptTag();
        }

        // TODO : gather accepted scripts.

        if(strlen($output)) {
            $output = '<!-- Cookie Consent -->' . PHP_EOL . $output;
        }

        return $output;
    }

    protected function getDefaultScriptTag(): string
    {
        return '<script '
            . 'src="' . asset(mix('script.js', 'vendor/laravel-cookie-consent')) . '" '
            . 'defer'
            . '></script>';
    }

    /**
     * Output the consent alert/modal for current consent state.
     */
    public function renderView(): string
    {
        return view('cookie-consent::cookies', [
            'cookies' => $this->registrar,
        ])->render();
    }
}
