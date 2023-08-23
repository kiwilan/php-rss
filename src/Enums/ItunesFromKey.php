<?php

namespace Kiwilan\Rss\Enums;

trait ItunesFromKey
{
    public static function fromKey(string $key, bool $throwException = true)
    {
        $toArrayAvailable = false;
        $array = [];

        try {
            $array = self::toArray();
            $toArrayAvailable = true;
        } catch (\Throwable $th) {
        }

        if (! $toArrayAvailable) {
            if ($throwException) {
                throw new \Exception('Method toArray() not found in '.self::class);
            }

            return null;

        }

        if (! array_key_exists($key, self::toArray())) {
            if ($throwException) {
                throw new \Exception('Key '.$key.' not found in '.self::class);
            }

            return null;
        }

        return self::tryFrom($array[$key]);
    }
}
