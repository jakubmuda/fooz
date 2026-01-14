<?php

namespace Fooz\Block;

abstract class AbstractBlock
{
    protected const BLOCK = '__BLOCK_NOT_SET__';
    protected const BLOCKS_DIR = __DIR__ . '/../../blocks';

    final public function register(): void
    {
        add_action('init', [$this, 'register_block']);
    }

    final public function register_block(): void
    {
        register_block_type(
            $this->get_type(),
            $this->get_args()
        );
    }

    protected function get_type(): string
    {
        return self::BLOCKS_DIR . '/' . static::BLOCK;
    }

    abstract protected function get_args(): array;
}
