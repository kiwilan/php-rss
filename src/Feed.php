<?php

namespace Kiwilan\Rss;

use Kiwilan\Rss\Feeds\FeedChannel;
use Kiwilan\Rss\Feeds\FeedConstants;
use Kiwilan\Rss\Feeds\Podcast\PodcastChannel;

class Feed
{
    protected function __construct(
        protected string $root = '',
        protected string $version = '1.0',
        protected ?string $encoding = null,
        protected ?bool $standalone = null,
        protected array $attributes = [],
        protected array $channel = [],
    ) {
    }

    public static function make(): self
    {
        $self = new self();

        return $self;
    }

    public function template(
        string $root = '',
        string $version = '1.0',
        ?string $encoding = null,
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

    public function raw(): FeedChannel
    {
        return FeedChannel::make($this);
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

    public function setChannel(array $channel): self
    {
        $this->channel = [
            ...$this->channel,
            ...$channel,
        ];

        return $this;
    }
}
