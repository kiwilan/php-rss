<?php

namespace Kiwilan\Rss\Enums;

enum ItunesTypeEnum: string
{
    use ItunesEnumToArrayTrait;
    use ItunesFromKey;

    case episodic = 'episodic';
    case serial = 'serial';
}
