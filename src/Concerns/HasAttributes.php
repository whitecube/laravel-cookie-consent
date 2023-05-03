<?php

namespace Whitecube\LaravelCookieConsent\Concerns;

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
     */
    public function getAttribute(string $attribute): mixed
    {
        return $this->attributes[$attribute] ?? null;
    }
}
