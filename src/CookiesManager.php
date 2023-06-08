<?php

namespace Whitecube\LaravelCookieConsent;

use Illuminate\Support\Facades\Cookie as CookieFacade;
use Symfony\Component\HttpFoundation\Cookie;

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
     * TODO
     */
    public function accept(string|array $categories = '*'): Cookie
    {
        if(! is_array($categories) || ! $categories) {
            $categories = array_map(fn($category) => $category->key(), $this->registrar->getCategories());
        }

        // TODO : call all registration callbacks for provided $categories

        return $this->makeConsentCookie($categories);
    }

    /**
     * TODO
     */
    protected function makeConsentCookie(array $categories): Cookie
    {
        $value = array_reduce($this->registrar->getCategories(), function($values, $category) use ($categories) {
            $state = in_array($category->key(), $categories);
            return array_reduce($category->getCookies(), function($values, $cookie) use ($state) {
                $values[$cookie->name] = $state;
                return $values;
            }, $values);
        }, ['consent_at' => time()]);

        return CookieFacade::make(
            name: config('cookieconsent.cookie.name'),
            value: json_encode($value),
            minutes: config('cookieconsent.cookie.duration'),
            domain: config('cookieconsent.cookie.domain'),
            secure: true
        );
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
