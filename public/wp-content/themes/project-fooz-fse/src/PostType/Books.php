<?php

namespace Fooz\PostType;

use Fooz\PostType\PostTypes;
use Fooz\TextDomains;

final class Books extends AbstractPostType
{
    protected const POST_TYPE = PostTypes::BOOKS;

    protected function get_args(): array
    {
        return [
            'public'                => true,
            'label'                 => __('Books', TextDomains::THEME),
            'menu_icon'             => 'dashicons-book',
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
            'show_in_rest'          => true,
            'rewrite'               => ['slug' => 'library'],
            'labels'                => [
                'name'          => __('Books', TextDomains::THEME),
                'singular_name' => __('Book', TextDomains::THEME),
                'menu_name'     => __('Books', TextDomains::THEME),
                'add_new'       => __('Add New', TextDomains::THEME),
                'add_new_item'  => __('Add New Book', TextDomains::THEME),
                'edit_item'     => __('Edit Book', TextDomains::THEME),
                'new_item'      => __('New Book', TextDomains::THEME),
                'view_item'     => __('View Book', TextDomains::THEME),
                'search_items'  => __('Search Books', TextDomains::THEME),
                'not_found'     => __('No books found', TextDomains::THEME),
            ],
        ];
    }
}
