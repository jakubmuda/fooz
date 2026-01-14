<?php

namespace Fooz\Block;

use Fooz\Block\Blocks;

final class FaqItem extends AbstractBlock
{
    protected const BLOCK = Blocks::FAQ_ITEM;

    protected function get_args(): array
    {
        return [];
    }
}
