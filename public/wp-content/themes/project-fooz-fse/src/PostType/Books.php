<?php

namespace Fooz\PostType;

use Fooz\PostType\PostTypes;

class Books extends AbstractPostType
{
    protected string $post_type = PostTypes::BOOKS;

    protected function get_args(): array
    {
        return [
            'public'                => true,
            'label'                 => __('Books', TEXT_DOMAIN_THEME),
            'menu_icon'             => 'dashicons-book',
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
            'show_in_rest'          => true,
            'rewrite'               => ['slug' => 'library'],
            'labels'                => [
                'name'          => __('Books', TEXT_DOMAIN_THEME),
                'singular_name' => __('Book', TEXT_DOMAIN_THEME),
                'menu_name'     => __('Books', TEXT_DOMAIN_THEME),
                'add_new'       => __('Add New', TEXT_DOMAIN_THEME),
                'add_new_item'  => __('Add New Book', TEXT_DOMAIN_THEME),
                'edit_item'     => __('Edit Book', TEXT_DOMAIN_THEME),
                'new_item'      => __('New Book', TEXT_DOMAIN_THEME),
                'view_item'     => __('View Book', TEXT_DOMAIN_THEME),
                'search_items'  => __('Search Books', TEXT_DOMAIN_THEME),
                'not_found'     => __('No books found', TEXT_DOMAIN_THEME),
            ],
        ];
    }
}
