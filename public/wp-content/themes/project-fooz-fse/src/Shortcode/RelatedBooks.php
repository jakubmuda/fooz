<?php

namespace Fooz\Shortcode;

final class RelatedBooks
{
    protected const SHORTCODE = 'fooz_related_books';

    public function register(): void
    {
        add_shortcode(self::SHORTCODE, [$this, 'render']);
    }

    public function render(): string
    {
        return sprintf(
            '<div id="fooz-related-books" data-post-id="%d">Loading related books...</div>',
            get_the_ID()
        );
    }
}
