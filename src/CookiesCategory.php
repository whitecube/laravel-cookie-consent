<?php

namespace Whitecube\LaravelCookieConsent;

use Closure;

class CookiesCategory
{
    use Concerns\HasAttributes;
    use Concerns\HasTranslations;
    use Concerns\HasCookies;

    /**
     * The category's identifier.
     */
    protected string $key;

    /**
     * Create a new cookies category container instance.
     */
    public function __construct(string $key)
    {
        $this->key = $key;
        $this->setAttribute('title', $this->translate('categories.' . $key . '.title', ucfirst($key)));
        $this->setAttribute('description', $this->translate('categories.' . $key . '.description'));
    }

    /**
     * Get this category's identifier.
     */
    public function key(): string
    {
        return $this->key;
    }

    /**
     * Add a group to this category.
     */
    public function group(Closure $callback): static
    {
        $group = new CookiesGroup();

        $callback($group);

        return $this->register($group);
    }

    /**
     * Configure a new cookie by calling one of its setting methods.
     */
    public function __call(string $method, array $arguments): Cookie
    {
        $instance = new Cookie();
        $instance->$method(...$arguments);

        $this->cookie($instance);

        return $instance;
    }
}
