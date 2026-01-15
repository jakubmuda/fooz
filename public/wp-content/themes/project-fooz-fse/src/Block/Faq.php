<?php

namespace Fooz\Block;

use Fooz\Block\Blocks;

final class Faq extends AbstractBlock
{
    protected const BLOCK = Blocks::FAQ;

    protected function get_args(): array
    {
        return [];
    }
}
