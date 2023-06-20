<?php

namespace Kiwilan\Rss;

use Kiwilan\Rss\Feeds\FeedConstants;
use Kiwilan\Rss\Feeds\Podcast\PodcastChannel;
use Kiwilan\Rss\Feeds\Raw\RawChannel;

class Feed
{
    /**
     * @param  array<string,string>  $attributes
     * @param  array<string,string>  $channel
     * @param  array<string,string>  $items
     */
    protected function __construct(
        protected string $root = 'rss',
        protected string $version = '1.0',
        protected string $encoding = 'UTF-8',
        protected ?bool $standalone = null,
        protected array $attributes = [],
        protected array $channel = [],
        protected array $items = [],
    ) {
    }

    public static function make(): self
    {
        $self = new self();

        return $self;
    }

    public function template(
        string $root = 'rss',
        string $version = '1.0',
        string $encoding = 'UTF-8',
        ?bool $standalone = null,
        array $attributes = [],
    ): self {
        $this->root = $root;
        $this->version = $version;
        $this->encoding = $encoding;
        $this->standalone = $standalone;
        $this->attributes = $attributes;

        return $this;
    }

    public function podcast(bool $autoTemplate = true): PodcastChannel
    {
        if ($autoTemplate) {
            $this->root = 'rss';
            $this->version = '1.0';
            $this->encoding = 'UTF-8';
            $this->attributes = [
                ...FeedConstants::PODCAST_FEED,
            ];
        }

        return PodcastChannel::make($this);
    }

    public function raw(): RawChannel
    {
        return RawChannel::make($this);
    }

    public function root(): string
    {
        return $this->root;
    }

    public function version(): string
    {
        return $this->version;
    }

    public function encoding(): ?string
    {
        return $this->encoding;
    }

    public function standalone(): ?bool
    {
        return $this->standalone;
    }

    public function attributes(): array
    {
        return $this->attributes;
    }

    public function channel(): array
    {
        return $this->channel;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function setChannel(array $channel): self
    {
        $this->channel = [
            ...$this->channel,
            ...$channel,
        ];

        return $this;
    }

    public function setItem(array $item): self
    {
        $this->items[] = [
            ...$item,
        ];

        return $this;
    }
}
