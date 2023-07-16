<?php

namespace Kiwilan\Rss\Feeds\Podcast;

class PodcastEnclosure
{
    protected function __construct(
        protected ?string $url = null,
        protected ?int $length = null,
        protected ?string $type = null,
    ) {
    }

    public static function make(): self
    {
        return new self();
    }

    public function url(): ?string
    {
        return $this->url;
    }

    public function length(): ?int
    {
        return $this->length;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function setUrl(?string $url): self
    {
        if ($url) {
            $this->url = $url;
        }

        return $this;
    }

    public function setLength(?int $length): self
    {
        if ($length) {
            $this->length = $length;
        }

        return $this;
    }

    public function setType(?string $type): self
    {
        if ($type) {
            $this->type = $type;
        }

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
