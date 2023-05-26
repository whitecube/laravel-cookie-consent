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

    /**
     * Output a single cookie consent action button.
     */
    public function renderButton(string $action, ?string $label = null, array $attributes = []): string
    {
        $url = match ($action) {
            'accept.all' => route('cookieconsent.accept.all'),
            'accept.essentials' => route('cookieconsent.accept.essentials'),
            'accept.configuration' => route('cookieconsent.accept.configuration'),
            'reset' => route('cookieconsent.reset'),
            default => null,
        };

        if(! $url) {
            throw new \InvalidArgumentException('Cookie consent action "' . $action . '" does not exist. Try one of these: "accept.all", "accept.essentials", "accept.configuration", "reset".');
        }

        $attributes = array_merge([
            'method' => 'post',
            'data-cookie-action' => $action,
        ], $attributes);

        if(! ($attributes['class'] ?? null)) {
            $attributes['class'] = 'cookiebtn';
        }

        $basename = explode(' ', $attributes['class'])[0];

        $attributes = collect($attributes)
            ->map(fn($value, $attribute) => $attribute . '="' . $value . '"')
            ->implode(' ');

        return view('cookie-consent::button', [
            'url' => $url,
            'label' => $label ?? $action, // TODO: use lang file
            'attributes' => $attributes,
            'basename' => $basename,
        ])->render();
    }
}
