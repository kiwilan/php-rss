<?php

namespace Kiwilan\Rss;

class FeedChannel
{
    protected function __construct(
    ) {
    }

    public static function make()
    {
        return new self();
    }
}
