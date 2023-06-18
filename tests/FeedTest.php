<?php

use Kiwilan\Rss\Feed;

it('can make rss feed', function () {
    $feed = Feed::make();
    $feed->save(OUTPUT);

    expect($feed)->toBeInstanceOf(Feed::class);
});
