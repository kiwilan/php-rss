<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesSocietyCultureCategoryEnum: string
{
    use ItunesEnumTrait;

    case society_culture_documentary = 'Documentary';
    case society_culture_personal_journals = 'Personal Journals';
    case society_culture_philosophy = 'Philosophy';
    case society_culture_places_and_travel = 'Places &amp; Travel';
    case society_culture_relationships = 'Relationships';
}
