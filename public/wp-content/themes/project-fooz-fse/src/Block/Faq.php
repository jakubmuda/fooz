<?php

namespace Fooz\Block;

use Fooz\Block\Blocks;

class Faq extends AbstractBlock
{
    public const BLOCK = Blocks::FAQ;

    protected function get_args(): array
    {
        return [];
    }
}
