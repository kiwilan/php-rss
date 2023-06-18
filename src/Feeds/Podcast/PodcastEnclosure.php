<?php

namespace Kiwilan\Rss\Feeds\Podcast;

class PodcastEnclosure
{
    public function __construct(
        protected ?string $url = null,
        protected ?int $length = null,
        protected ?string $type = null,
    ) {
    }

    public static function make(): self
    {
        return new self();
    }

    public function url(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function length(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function get(): array
    {
        return [
            '_attributes' => [
                'url' => $this->url,
                'length' => $this->length,
                'type' => $this->type,
            ],
        ];
    }
}
