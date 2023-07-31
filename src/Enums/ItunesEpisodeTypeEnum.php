<?php

namespace Kiwilan\Rss\Enums;

enum ItunesEpisodeTypeEnum: string
{
    use ItunesEnumToArrayTrait;
    use ItunesFromKey;

    case full = 'full';
    case trailer = 'trailer';
    case bonus = 'bonus';
}
