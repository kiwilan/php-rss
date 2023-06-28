<?php

namespace Kiwilan\Rss\Enums;

enum ItunesExplicitEnum: string
{
    use ItunesEnumTrait;

    case yes = 'yes';
    case no = 'no';
    case clean = 'clean';
}
