<?php

namespace Kiwilan\Rss\Feeds;

class FeedConstants
{
    public const PODCAST_FEED = [
        'xmlns:itunes' => 'http://www.itunes.com/dtds/podcast-1.0.dtd',
        'xmlns:googleplay' => 'http://www.google.com/schemas/play-podcasts/1.0',
        'xmlns:content' => 'http://purl.org/rss/1.0/modules/content/',
        'xmlns:atom' => 'http://www.w3.org/2005/Atom',
        'xmlns:spotify' => 'http://www.spotify.com/ns/rss',
        'xmlns:psc' => 'http://podlove.org/simple-chapters/',
        'xmlns:media' => 'https://search.yahoo.com/mrss/',
        'xmlns:podcastindex' => 'https://podcastindex.org/namespace/1.0',
        'xmlns:podlove' => 'http://podlove.org/simple-chapters/',
        'xmlns:podcast' => 'https://podcastindex.org/namespace/1.0',
        'version' => '2.0',
    ];

    public const RSS_FEED = [
        'xmlns:atom' => 'http://www.w3.org/2005/Atom',
        'version' => '2.0',
    ];
}
