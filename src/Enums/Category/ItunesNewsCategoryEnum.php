<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesNewsCategoryEnum: string
{
    use ItunesEnumTrait;

    case news_business = 'Business News';
    case news_daily = 'Daily News';
    case news_entertainmen = 'Entertainment News';
    case news_commentary = 'News Commentary';
    case news_politics = 'Politics';
    case news_sports = 'Sports News';
    case news_tech = 'Tech News';
}
