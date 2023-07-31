<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesSportsCategoryEnum: string
{
    use ItunesEnumTrait;

    case sports_baseball = 'Baseball';
    case sports_basketball = 'Basketball';
    case sports_cricket = 'Cricket';
    case sports_fantasy_sports = 'Fantasy Sports';
    case sports_football = 'Football';
    case sports_golf = 'Golf';
    case sports_hockey = 'Hockey';
    case sports_rugby = 'Rugby';
    case sports_soccer = 'Soccer';
    case sports_swimming = 'Swimming';
    case sports_tennis = 'Tennis';
    case sports_volleyball = 'Volleyball';
    case sports_wilderness = 'Wilderness';
    case sports_wrestling = 'Wrestling';
}
