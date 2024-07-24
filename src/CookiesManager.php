<?php

namespace Whitecube\LaravelCookieConsent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie as CookieFacade;
use Symfony\Component\HttpFoundation\Cookie as CookieComponent;

class CookiesManager
{
    /**
     * The cookies registrar.
     */
    protected CookiesRegistrar $registrar;

    /**
     * The user's current consent preferences.
     */
    protected ?array $preferences = null;

    /**
     * Create a new Service Manager instance.
     */
    public function __construct(CookiesRegistrar $registrar, Request $request)
    {
        $this->registrar = $registrar;
        $this->preferences = $this->getCurrentConsentSettings($request);
    }

    /**
     * Retrieve the eventual existing cookie data.
     */
    protected function getCurrentConsentSettings(Request $request): ?array
    {
        $preferences = ($raw = $request->cookie(config('cookieconsent.cookie.name')))
            ? json_decode($raw, true)
            : null;

        if(! $preferences || ! is_int($preferences['consent_at'] ?? null)) {
            return null;
        }

        // Check duration in case application settings have changed since the cookie was set.
        if($preferences['consent_at'] + (config('cookieconsent.cookie.duration') * 60) < time()) {
            return null;
        }

        return $preferences;
    }

    /**
     * Create fresh cookie data for the given consented categories.
     */
    protected function makeConsentSettings(array $categories): array
    {
        return array_reduce($this->registrar->getCategories(), function($values, $category) use ($categories) {
            $state = in_array($category->key(), $categories);
            return array_reduce($category->getCookies(), function($values, $cookie) use ($state) {
                $values[$cookie->name] = $state;
                return $values;
            }, $values);
        }, ['consent_at' => time()]);
    }

    /**
     * Transfer all undefined method calls to the registrar.
     */
    public function __call(string $method, array $arguments)
    {
        return $this->registrar->$method(...$arguments);
    }

    /**
     * Check if the current preference settings are sufficient. If not,
     * the cookie preferences notice should be displayed again.
     */
    public function shouldDisplayNotice(): bool
    {
        if(! $this->preferences) {
            return true;
        }

        // Check if each defined cookie has been shown to the user yet.
        return array_reduce($this->registrar->getCategories(), function($state, $category) {
            return $state ? true : array_reduce($category->getCookies(), function(bool $state, Cookie $cookie) {
                return $state ? true : !array_key_exists($cookie->name, $this->preferences);
            }, false);
        }, false);
    }

    /**
     * Check if the user has given explicit consent for a specific cookie.
     */
    public function hasConsentFor(string $key): bool
    {
        if(! $this->preferences) {
            return false;
        }

        $groups = array_reduce($this->registrar->getCategories(), function($results, $category) use ($key) {
            return array_reduce($category->getDefined(), function(array $results, Cookie|CookiesGroup $instance) use ($key) {
                if(is_a($instance, CookiesGroup::class) && $instance->name === $key) {
                    $results[] = $instance;
                }
                return $results;
            }, $results);
        }, []);

        $cookies = $groups
            ? array_unique(array_reduce($groups, fn($cookies, $group) => array_merge($cookies, array_map(fn($cookie) => $cookie->name, $group->getCookies())), []))
            : [$key];

        foreach($cookies as $cookie) {
            if(! boolval($this->preferences[$cookie] ?? false)) return false;
        }

        return true;
    }

    /**
     * Handle the incoming consent preferences accordingly.
     */
    public function accept(string|array $categories = '*'): ConsentResponse
    {
        if(! is_array($categories) || ! $categories) {
            $categories = array_map(fn($category) => $category->key(), $this->registrar->getCategories());
        }

        $this->preferences = $this->makeConsentSettings($categories);

        $response = $this->getConsentResponse();
        $response->attachCookie($this->makeConsentCookie());

        return $response;
    }

    /**
     * Call all the consented cookie callbacks and gather their
     * scripts and/or cookies that should be returned along the
     * current request's response.
     */
    protected function getConsentResponse(): ConsentResponse
    {
        return array_reduce($this->registrar->getCategories(), function($response, $category) {
            return array_reduce($category->getDefined(), function(ConsentResponse $response, Cookie|CookiesGroup $instance) {
                return $this->hasConsentFor($instance->name)
                    ? $response->handleConsent($instance)
                    : $response;
            }, $response);
        }, new ConsentResponse());
    }

    /**
     * Create a new cookie instance for the given consented categories.
     */
    protected function makeConsentCookie(): CookieComponent
    {
        return CookieFacade::make(
            name: config('cookieconsent.cookie.name'),
            value: json_encode($this->preferences),
            minutes: config('cookieconsent.cookie.duration'),
            domain: config('cookieconsent.cookie.domain'),
            secure: (env('APP_ENV') == 'local') ? false : true
        );
    }

    /**
     * Output all the scripts for current consent state.
     */
    public function renderScripts(bool $withDefault = true): string
    {
        $output = $this->shouldDisplayNotice()
            ? $this->getNoticeScripts($withDefault)
            : $this->getConsentedScripts($withDefault);

        if(strlen($output)) {
            $output = '<!-- Cookie Consent -->' . $output;
        }

        return $output;
    }

    public function getNoticeScripts(bool $withDefault): string
    {
        return $withDefault ? $this->getDefaultScriptTag() : '';
    }

    protected function getConsentedScripts(bool $withDefault): string
    {
        $output = $this->getNoticeScripts($withDefault);

        foreach ($this->getConsentResponse()->getResponseScripts() ?? [] as $tag) {
            $output .= $tag;
        }

        return $output;
    }

    protected function getDefaultScriptTag(): string
    {
        return '<script '
            . 'src="' . route('cookieconsent.script') . '?id='
            . md5(\filemtime(LCC_ROOT . '/dist/script.js')) . '" '
            . 'defer'
            . '></script>';
    }

    /**
     * Output the consent alert/modal for current consent state.
     */
    public function renderView(): string
    {
        return $this->shouldDisplayNotice()
            ? $this->getNoticeMarkup()
            : '';
    }

    public function getNoticeMarkup(): string
    {
        if($policy = config('cookieconsent.policy')) {
            $policy = route($policy);
        }

        return view('cookie-consent::cookies', [
            'cookies' => $this->registrar,
            'policy' => $policy,
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

    /**
     * Output a table with all the cookies infos.
     */
    public function renderInfo(): string
    {
        return view('cookie-consent::info', [
            'cookies' => $this->registrar,
        ])->render();
    }

    public function replaceInfoTag(string $wysiwyg): string
    {
        $cookieConsentInfo = view('cookie-consent::info', [
            'cookies' => $this->registrar,
        ])->render();
        
        $formattedString = preg_replace(
            [
                '/\<(\w)[^\>]+\>\@cookieconsentinfo\<\/\1\>/',
                '/\@cookieconsentinfo/',
            ],
            $cookieConsentInfo,
            $wysiwyg,
        );

        return $formattedString;
    }
}
