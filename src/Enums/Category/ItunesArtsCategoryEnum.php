<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesArtsCategoryEnum: string
{
    use ItunesEnumTrait;

    case arts_books = 'Books';
    case arts_design = 'Design';
    case arts_fashion_and_beauty = 'Fashion &amp; Beauty';
    case arts_food = 'Food';
    case arts_performing_arts = 'Performing Arts';
    case arts_visual_arts = 'Visual Arts';
}
