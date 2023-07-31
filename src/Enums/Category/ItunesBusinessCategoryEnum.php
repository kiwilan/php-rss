<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesBusinessCategoryEnum: string
{
    use ItunesEnumTrait;

    case business_careers = 'Careers';
    case business_entrepreneurship = 'Entrepreneurship';
    case business_investing = 'Investing';
    case business_management = 'Management';
    case business_marketing = 'Marketing';
    case business_non_profit = 'Non-Profit';
}
