<?php

namespace Fooz\Shortcode;

abstract class AbstractShortcode
{
    protected const SHORTCODE = '__SHORTCODE_NOT_SET__';

    final public function register(): void
    {
        add_shortcode(static::SHORTCODE, [$this, 'render']);
    }

    abstract public function render(): string;
}
