<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesEducationCategoryEnum: string
{
    use ItunesEnumTrait;

    case education_courses = 'Courses';
    case education_how_to = 'How To';
    case education_language_learning = 'Language Learning';
    case education_self_improvement = 'Self-Improvement';
}
