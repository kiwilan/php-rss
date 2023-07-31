<?php

namespace Kiwilan\Rss\Enums;

trait ItunesFromKey
{
    public static function fromKey(string $key): self
    {
        $toArrayAvailable = false;

        try {
            self::toArray();
            $toArrayAvailable = true;
        } catch (\Throwable $th) {

        }

        if (! $toArrayAvailable) {
            throw new \Exception('Method toArray() not found in '.self::class);
        }

        if (! array_key_exists($key, self::toArray())) {
            throw new \Exception('Key '.$key.' not found in '.self::class);
        }

        $array = self::toArray();
        $value = $array[$key];

        return self::from($value);
    }
}
