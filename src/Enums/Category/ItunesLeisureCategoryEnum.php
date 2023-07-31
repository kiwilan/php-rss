<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesLeisureCategoryEnum: string
{
    use ItunesEnumTrait;

    case leisure_animation_and_manga = 'Animation &amp; Manga';
    case leisure_automotive = 'Automotive';
    case leisure_aviation = 'Aviation';
    case leisure_crafts = 'Crafts';
    case leisure_games = 'Games';
    case leisure_hobbies = 'Hobbies';
    case leisure_home_and_garden = 'Home &amp; Garden';
    case leisure_video_games = 'Video Games';
}
