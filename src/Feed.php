<?php

namespace Kiwilan\Rss;

use Spatie\ArrayToXml\ArrayToXml;

class Feed
{
    public static function make(): self
    {
        $self = new self();

        return $self;
    }

    public function render(): string
    {
        return ArrayToXml::convert(
            array: [
                '_attributes' => [
                    ...FeedConstants::FEED,
                ],
            ],
            rootElement: 'rss',
            xmlEncoding: 'UTF-8',
        );
    }

    public function save(string $path): bool
    {
        return file_put_contents($path, $this->render()) !== false;
    }
}
