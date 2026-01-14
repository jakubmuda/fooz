<?php

namespace Fooz\Taxonomy;

use Fooz\PostType\PostTypes;
use Fooz\Taxonomy\Taxonomies;

class Genre extends AbstractTaxonomy
{
    public const TAXONOMY = Taxonomies::GENRE;

    protected function get_object_types(): array|string
    {
        return PostTypes::BOOKS;
    }

    protected function get_args(): array
    {
        return [
            'label'         => 'Kategorie',
            'public'        => true,
            'hierarchical'  => true,
            'show_in_rest'  => true,
            'rewrite'       => ['slug' => 'book-genre'],
            'labels'        => [
                'name'              => __('Genres', TEXT_DOMAIN_THEME),
                'singular_name'     => __('Genre', TEXT_DOMAIN_THEME),
                'search_items'      => __('Search Genres', TEXT_DOMAIN_THEME),
                'all_items'         => __('All Genres', TEXT_DOMAIN_THEME),
                'edit_item'         => __('Edit Genre', TEXT_DOMAIN_THEME),
                'update_item'       => __('Update Genre', TEXT_DOMAIN_THEME),
                'add_new_item'      => __('Add New Genre', TEXT_DOMAIN_THEME),
                'new_item_name'     => __('New Genre Name', TEXT_DOMAIN_THEME),
                'menu_name'         => __('Genre', TEXT_DOMAIN_THEME),
            ],
        ];
    }
}
