<?php

namespace Fooz\PostType;

abstract class AbstractPostType
{
    protected string $post_type;

    final public function register(): void
    {
        add_action('init', [$this, 'register_post_type']);
    }

    final public function register_post_type(): void
    {
        register_post_type(
            static::$post_type,
            $this->get_args()
        );
    }

    abstract protected function get_args(): array;
}
