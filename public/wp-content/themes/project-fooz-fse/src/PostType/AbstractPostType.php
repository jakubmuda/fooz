<?php

namespace Fooz\PostType;

abstract class AbstractPostType
{
    protected const POST_TYPE = '__POST_TYPE_NOT_SET__';
    
    final public function register(): void
    {
        add_action('init', [$this, 'register_post_type']);
    }

    final public function register_post_type(): void
    {
        register_post_type(
            static::POST_TYPE,
            $this->get_args()
        );
    }

    abstract protected function get_args(): array;
}
