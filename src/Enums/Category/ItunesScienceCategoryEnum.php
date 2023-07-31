<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesScienceCategoryEnum: string
{
    use ItunesEnumTrait;

    case science_astronomy = 'Astronomy';
    case science_chemistry = 'Chemistry';
    case science_earth_sciences = 'Earth Sciences';
    case science_life_sciences = 'Life Sciences';
    case science_mathematics = 'Mathematics';
    case science_natural_sciences = 'Natural Sciences';
    case science_nature = 'Nature';
    case science_physics = 'Physics';
    case science_social_sciences = 'Social Sciences';
}
