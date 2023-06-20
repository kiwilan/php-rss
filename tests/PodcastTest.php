<?php

use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesEpisodeTypeEnum;
use Kiwilan\Rss\Enums\ItunesExplicit;
use Kiwilan\Rss\Enums\ItunesSubCategoryEnum;
use Kiwilan\Rss\Enums\ItunesTypeEnum;
use Kiwilan\Rss\Feed;
use Kiwilan\Rss\Feeds\FeedConstants;
use Kiwilan\Rss\Feeds\Podcast\PodcastItem;
use Kiwilan\XmlReader\XmlReader;

it('can make podcast feed', function () {
    $podcast = Feed::make()->podcast()
        ->title('2 Heures De Perdues')
        ->link('https://www.2hdp.fr')
        ->subtitle('Pourquoi gagner du temps quand on peut en perdre devant de mauvais films ?')
        ->description('Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films')
        ->language('fr')
        ->copyright('℗ & © 2019 Fréquence Moderne')
        ->lastUpdate('2021-09-01 00:00:00')
        ->webmaster('feeds@ausha.co (Ausha)')
        ->generator('Ausha (https://www.ausha.co)')
        ->keywords(['films', 'critiques', 'comédie'])
        ->author('2 Heures De Perdues', '2heuresdeperdues@gmail.com')
        ->explicit(ItunesExplicit::yes)
        ->isPrivate()
        ->type(ItunesTypeEnum::episodic)
        ->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_films_film_reviews)
        ->addCategory(ItunesCategoryEnum::leisure, ItunesSubCategoryEnum::leisure_hobbies)
        ->image('https://raw.githubusercontent.com/kiwilan/php-rss/main/tests/examples/folder.jpeg');

    $item1 = PodcastItem::make()
        ->title("Peau d'Ane")
        ->guid('custom-and-unique-key', isPermaLink: true)
        ->subtitle('On discute du chef d\'oeuvre de Jacques. Des réactions ? @2_HDP')
        ->description('<p>On discute du chef d\'oeuvre de Jacques. Des réactions ? @2_HDP</p>')
        ->publishDate('2023-06-14 08:39:25')
        ->enclosure(
            url: 'https://chtbl.com/track/47E579/https://audio.ausha.co/B4mpWfDq5KDa.mp3?t=1685693288',
            length: 56898528,
            type: 'audio/mpeg'
        )
        ->link('https://podcast.ausha.co/2-heures-de-perdues/peau-d-ane')
        ->author('2 Heures de Perdues')
        ->keywords(['keyword1', 'keyword2'])
        ->duration(3551)
        ->episodeType(ItunesEpisodeTypeEnum::full)
        ->season(9)
        ->episode(34)
        ->isExplicit(false)
        ->image('https://image.ausha.co/XboDHYC69Oorw8MBObAkQ2sTPdxGTkexH3nYQ8Ky_1400x1400.jpeg?t=1619074925');

    $item3 = PodcastItem::make()
        ->title('Movie')
        ->link('https://podcast.ausha.co/2-heures-de-perdues/peau-d-ane')
        ->publishDate('2023-06-14 08:39:25')
        ->enclosure(
            url: 'https://chtbl.com/track/47E579/https://audio.ausha.co/B4mpWfDq5KDa.mp3?t=1685693288',
            length: 56898528,
            type: 'audio/mpeg'
        );

    $podcast->addItem($item1);
    $podcast->addItem([
        'title' => 'Movie',
        'link' => 'https://podcast.ausha.co/2-heures-de-perdues/peau-d-ane',
        'publishDate' => '2023-06-14 08:39:25',
        'enclosure' => [
            'url' => 'https://chtbl.com/track/47E579/https://audio.ausha.co/B4mpWfDq5KDa.mp3?t=1685693288',
            'length' => 56898528,
            'type' => 'audio/mpeg',
        ],
    ]);
    $podcast->addItem($item3);

    $xml = $podcast->get();
    $podcast->save(OUTPUT.'/feed-podcast-items.xml');

    $xml = XmlReader::make($xml);

    expect($xml->root())->toBe('rss');
    expect($xml->search('title'))->toBe('2 Heures De Perdues');
    expect($xml->search('link'))->toBe('https://www.2hdp.fr');
    expect($xml->search('description'))->toBe('Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films');
    expect($xml->search('language'))->toBe('fr');
    expect($xml->search('lastBuildDate'))->toBe('Wed, 01 Sep 2021 00:00:00 +0000');
    expect($xml->search('webMaster'))->toBe('feeds@ausha.co (Ausha)');
    expect($xml->search('generator'))->toBe('Ausha (https://www.ausha.co)');
    expect($xml->search('itunes:keywords'))->toBe('films,critiques,comédie');
    expect($xml->search('itunes:author'))->toBe('2 Heures De Perdues');
    expect($xml->search('itunes:name'))->toBe('2 Heures De Perdues');
    expect($xml->search('itunes:email'))->toBe('2heuresdeperdues@gmail.com');
    expect($xml->search('itunes:explicit'))->toBe('yes');
    expect($xml->search('itunes:block'))->toBe('Yes');
    expect($xml->search('itunes:type'))->toBe('episodic');

    $categories = $xml->search('category');
    expect($categories[0])->toBe('TV &amp; Film');
    expect($categories[1])->toBe('Leisure');

    $itunesCategories = $xml->search('itunes:category');
    expect($itunesCategories[0]['@attributes']['text'])->toBe('TV &amp; Film');
    expect($itunesCategories[0]['itunes:category']['@attributes']['text'])->toBe('Film Reviews');
    expect($itunesCategories[1]['@attributes']['text'])->toBe('Leisure');
    expect($itunesCategories[1]['itunes:category']['@attributes']['text'])->toBe('Hobbies');
    expect($xml->search('itunes:image')['@attributes']['href'])->toBe('https://raw.githubusercontent.com/kiwilan/php-rss/main/tests/examples/folder.jpeg');
    expect($xml->search('item'))->toBeArray();
    expect($xml->search('item'))->toHaveCount(3);
});

it('can save xml', function () {
    $podcast = getPodcastChannel();
    $path = OUTPUT.'/feed-podcast.xml';
    $podcast->save($path);

    expect(file_exists($path))->toBeTrue();
});

it('can make raw feed', function () {
    $podcast = Feed::make()
        ->template(
            root: 'rss',
            version: '1.0',
            encoding: 'UTF-8',
            attributes: [
                ...FeedConstants::RSS_FEED,
                'xmlns:itunes' => 'http://www.itunes.com/dtds/podcast-1.0.dtd',
            ],
        )
        ->raw()
        ->channel([
            'title' => '2 Heures De Perdues',
            'link' => 'https://www.2hdp.fr',
            'description' => 'Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films',
            'language' => 'fr',
            'lastBuildDate' => 'Wed, 01 Sep 2021 00:00:00 +0000',
        ])
        ->addItem([
            'title' => "Peau d'Ane",
            'link' => 'https://podcast.ausha.co/2-heures-de-perdues/peau-d-ane',
            'description' => '<p>On discute du chef d\'oeuvre de Jacques. Des réactions ? @2_HDP</p>',
            'pubDate' => 'Wed, 14 Jun 2023 08:39:25 +0000',
            'enclosure' => [
                '_attributes' => [
                    'url' => 'https://chtbl.com/track/47E579/https://audio.ausha.co/B4mpWfDq5KDa.mp3?t=1685693288',
                    'length' => '56898528',
                    'type' => 'audio/mpeg',
                ],
            ],
            '__custom:itunes\\:author' => '2 Heures de Perdues',
            '__custom:itunes\\:duration' => '00:59:11',
            '__custom:itunes\\:episodeType' => 'full',
        ]);

    $xml = $podcast->get();
    $podcast->save(OUTPUT.'/feed-podcast-raw.xml');

    $xml = XmlReader::make($xml);

    expect($xml->root())->toBe('rss');
});
