<?php

namespace Fooz\Block;

abstract class AbstractBlock
{
    protected const BLOCKS_DIR = __DIR__ . '/../../blocks';

    final public function register(): void
    {
        add_action('init', [$this, 'register_block']);
    }

    final public function register_block(): void
    {
        register_block_type($this->get_path());
    }

    protected function get_path(): string
    {
        return self::BLOCKS_DIR . '/' . static::BLOCK;
    }
}
