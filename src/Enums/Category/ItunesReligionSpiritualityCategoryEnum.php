<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesReligionSpiritualityCategoryEnum: string
{
    use ItunesEnumTrait;

    case religion_spirituality_buddhism = 'Buddhism';
    case religion_spirituality_christianity = 'Christianity';
    case religion_spirituality_hinduism = 'Hinduism';
    case religion_spirituality_islam = 'Islam';
    case religion_spirituality_judaism = 'Judaism';
    case religion_spirituality_religion = 'Religion';
    case religion_spirituality_spirituality = 'Spirituality';
}
