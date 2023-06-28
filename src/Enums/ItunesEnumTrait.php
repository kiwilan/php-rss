<?php

namespace Kiwilan\Rss\Enums;

trait ItunesEnumTrait
{
    public static function toArray()
    {
        $cases = self::cases();
        $enums = [];

        /** @var BackedEnum $enum */
        foreach ($cases as $key => $enum) {
            $enums[$enum->name] = $enum->value;
        }

        return $enums;
    }
}
