<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesMusicCategoryEnum: string
{
    use ItunesEnumTrait;

    case music_commentary = 'Music Commentary';
    case music_history = 'Music History';
    case music_interviews = 'Music Interviews';
}
