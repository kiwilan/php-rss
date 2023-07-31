<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesComedyCategoryEnum: string
{
    use ItunesEnumTrait;

    case comedy_comedy_interviews = 'Comedy Interviews';
    case comedy_improv = 'Improv';
    case comedy_stand_up = 'Stand-Up';
}
