<?php

use Kiwilan\Rss\Feed;
use Kiwilan\Rss\Feeds\FeedChannel;

it('can make rss feed', function () {
    $feed = Feed::make()->raw();
    $feed->save(OUTPUT.'/feed.xml');

    expect($feed)->toBeInstanceOf(FeedChannel::class);
});
