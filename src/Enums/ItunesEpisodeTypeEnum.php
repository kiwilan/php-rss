<?php

namespace Kiwilan\Rss\Enums;

enum ItunesEpisodeTypeEnum: string
{
    use ItunesEnumTrait;

    case full = 'full';
    case trailer = 'trailer';
    case bonus = 'bonus';
}
