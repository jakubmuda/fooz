<?php

namespace Fooz\Taxonomy;

use Fooz\PostType\PostTypes;
use Fooz\Taxonomy\Taxonomies;
use Fooz\TextDomains;

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
                'name'              => __('Genres', TextDomains::THEME),
                'singular_name'     => __('Genre', TextDomains::THEME),
                'search_items'      => __('Search Genres', TextDomains::THEME),
                'all_items'         => __('All Genres', TextDomains::THEME),
                'edit_item'         => __('Edit Genre', TextDomains::THEME),
                'update_item'       => __('Update Genre', TextDomains::THEME),
                'add_new_item'      => __('Add New Genre', TextDomains::THEME),
                'new_item_name'     => __('New Genre Name', TextDomains::THEME),
                'menu_name'         => __('Genre', TextDomains::THEME),
            ],
        ];
    }
}
