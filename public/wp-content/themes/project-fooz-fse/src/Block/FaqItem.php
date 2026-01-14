<?php

namespace Fooz\Block;

use Fooz\Blocks\Blocks;

class FaqItem extends AbstractBlock
{
    public const BLOCK = Blocks::FAQ_ITEM;

    protected function get_args(): array
    {
        return [];
    }
}
