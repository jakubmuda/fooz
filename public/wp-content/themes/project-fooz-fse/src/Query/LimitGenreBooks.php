<?php

namespace Fooz\Query;

use Fooz\Taxonomy\Taxonomies;

final class LimitGenreBooks
{
    private const LIMIT = 5;

    public function register(): void
    {
        add_action('pre_get_posts', [$this, 'applyLimit']);
    }

    public function applyLimit(\WP_Query $query): void
    {
        if (
            !is_admin() &&
            $query->is_main_query() &&
            is_tax(Taxonomies::GENRE)
        ) {
            $query->set('posts_per_page', self::LIMIT);
        }
    }
}
