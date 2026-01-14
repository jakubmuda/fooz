<?php

namespace Fooz;

use Fooz\PostType\PostTypes;

final class ThemeSetup
{
    public static function register(): void
    {
        add_action('after_setup_theme', [self::class, 'setup']);
    }

    public static function setup(): void
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails', [
            PostTypes::BOOKS,
            PostTypes::POST,
        ]);
    }
}
