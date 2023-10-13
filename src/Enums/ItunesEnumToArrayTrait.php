<?php

namespace Kiwilan\Rss\Enums;

trait ItunesEnumToArrayTrait
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

    public static function toDatabase()
    {
        return self::toArray();
    }
}
