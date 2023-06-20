<?php

namespace Kiwilan\Rss\Feeds\Raw;

use Kiwilan\Rss\Feed;
use Kiwilan\Rss\Feeds\FeedChannel;

class RawChannel extends FeedChannel
{
    protected function __construct(
        protected Feed $feed,
        protected array $items = [],
    ) {
        parent::__construct($feed);
    }

    public function channel(array $data): self
    {
        $this->feed->setChannel([
            ...$data,
        ]);

        return $this;
    }

    public function addItem(array $item): self
    {
        $this->items[] = $item;
        $this->feed->setItem($item);

        return $this;
    }
}
