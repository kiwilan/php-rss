<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesKidsFamilyCategoryEnum: string
{
    use ItunesEnumTrait;

    case kids_family_education_for_kids = 'Education for Kids';
    case kids_family_parenting = 'Parenting';
    case kids_family_pets_and_animals = 'Pets &amp; Animals';
    case kids_family_stories_for_kids = 'Stories for Kids';
}
