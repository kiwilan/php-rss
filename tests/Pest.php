<?php

use Kiwilan\Rss\Enums\ItunesEpisodeTypeEnum;
use Kiwilan\Rss\Feeds\Podcast\PodcastEnclosure;
use Kiwilan\Rss\Feeds\Podcast\PodcastItem;

define('OUTPUT', __DIR__.'/output');
define('ITEMS', [
    new PodcastItem(
        title: "Peau d'Ane",
        subtitle: 'On discute du chef d\'oeuvre de Jacques. Des réactions ? @2_HDP',
        description: '<p>On discute du chef d\'oeuvre de Jacques. Des réactions ? @2_HDP</p>',
        publishDate: new DateTime('2023-06-14 08:39:25'),
        enclosure: new PodcastEnclosure(
            url: 'https://chtbl.com/track/47E579/https://audio.ausha.co/B4mpWfDq5KDa.mp3?t=1685693288',
            length: 56898528,
            type: 'audio/mpeg',
        ),
        link: 'https://podcast.ausha.co/2-heures-de-perdues/peau-d-ane',
        author: '2 Heures de Perdues',
        keywords: [],
        duration: 3551,
        episodeType: ItunesEpisodeTypeEnum::full,
        season: 9,
        episode: 34,
        isExplicit: false,
        image: 'https://image.ausha.co/XboDHYC69Oorw8MBObAkQ2sTPdxGTkexH3nYQ8Ky_1400x1400.jpeg?t=1619074925',
    ),
    new PodcastItem(
        title: 'Les Dents de la Mer',
        subtitle: 'On discute du chef d\'oeuvre de Steven. Des réactions ? @2_HDP',
        description: '<p>On discute du chef d\'oeuvre de Steven. Des réactions ? @2_HDP</p>',
        publishDate: new DateTime('2023-06-07 14:19:12'),
        enclosure: new PodcastEnclosure(
            url: 'https://chtbl.com/track/47E579/https://audio.ausha.co/bWKZWTDW75RR.mp3?t=1685692067',
            length: 73226104,
            type: 'audio/mpeg',
        ),
        link: 'https://podcast.ausha.co/2-heures-de-perdues/les-dents-de-la-mer',
        author: '2 Heures de Perdues',
        keywords: [],
        duration: 4571,
        episodeType: ItunesEpisodeTypeEnum::full,
        season: 9,
        episode: 33,
        isExplicit: false,
        image: 'https://image.ausha.co/XboDHYC69Oorw8MBObAkQ2sTPdxGTkexH3nYQ8Ky_1400x1400.jpeg?t=1619074925',
    ),
]);
