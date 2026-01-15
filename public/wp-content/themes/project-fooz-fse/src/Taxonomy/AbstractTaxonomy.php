<?php

namespace Fooz\Taxonomy;

abstract class AbstractTaxonomy
{
    protected const TAXONOMY = '__TAXONOMY_NOT_SET__';

    final public function register(): void
    {
        add_action('init', [$this, 'register_taxonomy']);
    }

    final public function register_taxonomy(): void
    {
        register_taxonomy(
            static::TAXONOMY,
            $this->get_object_types(),
            $this->get_args()
        );
    }

    abstract protected function get_object_types(): array|string;

    abstract protected function get_args(): array;
}
