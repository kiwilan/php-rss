<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesTVFilmCategoryEnum: string
{
    use ItunesEnumTrait;

    case tv_film_after_shows = 'After Shows';
    case tv_film_film_history = 'Film History';
    case tv_film_film_interviews = 'Film Interviews';
    case tv_film_film_reviews = 'Film Reviews';
    case tv_film_tv_reviews = 'TV Reviews';
}
