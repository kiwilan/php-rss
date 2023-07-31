<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesFictionCategoryEnum: string
{
    use ItunesEnumTrait;

    case fiction_comedy_fiction = 'Comedy Fiction';
    case fiction_drama = 'Drama';
    case fiction_science_fiction = 'Science Fiction';
}
