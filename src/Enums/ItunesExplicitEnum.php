<?php

namespace Kiwilan\Rss\Enums;

enum ItunesExplicitEnum: string
{
    use ItunesEnumToArrayTrait;
    use ItunesFromKey;

    case yes = 'yes';
    case no = 'no';
    case clean = 'clean';
}
