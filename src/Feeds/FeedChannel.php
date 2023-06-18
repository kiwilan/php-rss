<?php

namespace Kiwilan\Rss\Feeds;

use Kiwilan\Rss\Feed;
use Spatie\ArrayToXml\ArrayToXml;

class FeedChannel
{
    protected function __construct(
        protected Feed $feed,
    ) {
    }

    public static function make(Feed $feed): static
    {
        return new static($feed);
    }

    /**
     * Get the feed as xml string.
     */
    public function get(): string
    {
        ray($this->feed->items());

        return ArrayToXml::convert(
            array: [
                '_attributes' => $this->feed->attributes(),
                'channel' => [
                    ...$this->feed->channel(),
                    'item' => $this->feed->items(),
                ],
            ],
            rootElement: $this->feed->root(),
            xmlEncoding: $this->feed->encoding(),
            xmlVersion: $this->feed->version(),
            xmlStandalone: $this->feed->standalone(),
        );
    }

    public function save(string $path): bool
    {
        return file_put_contents($path, $this->get()) !== false;
    }
}
