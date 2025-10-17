<?php

namespace Whitecube\LaravelCookieConsent\Concerns;

use Closure;

trait HasAttributes
{
    /**
     * The displayable attributes.
     */
    protected array $attributes = [];

    /**
     * Magically set an attribute.
     */
    public function __set(string $attribute, mixed $value): void
    {
        $this->setAttribute($attribute, $value);
    }

    /**
     * Magically get an attribute.
     */
    public function __get(string $attribute): mixed
    {
        return $this->getAttribute($attribute);
    }

    /**
     * Set all defined attributes at once.
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * Get all defined attributes at once.
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Set a specific attribute's value.
     */
    public function setAttribute(string $attribute, mixed $value): void
    {
        $this->attributes[$attribute] = $value;
    }

    /**
     * Get a specific attribute's value.
     *
     * The closures are only executed when the view accesses the attributes,
     * ensuring that the current locale has already been set and translations
     * are rendered correctly.
     *
     * This lazy evaluation approach is necessary because translations depend
     *  on the active locale at render time. If the closures were executed earlier
     *  (e.g., when the attribute was assigned), they might use the wrong locale,
     *  causing incorrect or untranslated text to appear in the output.
     * 
     */
    public function getAttribute(string $attribute): mixed
    {
        $value = $this->attributes[$attribute] ?? null;

        return $value instanceof Closure ? $value() : $value;
    }
}
