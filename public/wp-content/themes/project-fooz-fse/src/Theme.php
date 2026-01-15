<?php

namespace Fooz;

use Fooz\Assets;
use Fooz\Block;
use Fooz\PostType;
use Fooz\Query;
use Fooz\Shortcode;
use Fooz\Taxonomy;
use Fooz\ThemeSetup;

final class Theme
{
    public static function init(): void
    {
        Assets::register();
        ThemeSetup::register();
        
        // QUERY
        (new Query\LimitGenreBooks())->register();
        (new Query\RelatedBooksAjax())->register();

        // POST TYPE
        (new PostType\Books())->register();

        // TAXONOMY
        (new Taxonomy\Genre())->register();

        // BLOCK
        (new Block\Faq())->register();
        (new Block\FaqItem())->register();

        // SHORTCODE
        (new Shortcode\RelatedBooks())->register();

    }
}
