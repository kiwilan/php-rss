<?php

namespace Kiwilan\Rss\Enums;

enum ItunesTypeEnum: string
{
    use ItunesEnumTrait;

    case episodic = 'episodic';
    case serial = 'serial';
}
