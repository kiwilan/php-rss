<?php

use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesEpisodeTypeEnum;
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
        ->atomLink('https://www.2hdp.fr/xml')
        ->subtitle('Pourquoi gagner du temps quand on peut en perdre devant de mauvais films ?')
        ->description('Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films')
        ->language('fr')
        ->copyright('℗ & © 2019 Fréquence Moderne')
        ->lastUpdate('2021-09-01 00:00:00')
        ->webmaster('feeds@ausha.co (Ausha)')
        ->generator('Ausha (https://www.ausha.co)')
        ->keywords(['films', 'critiques', 'comédie'])
        ->author('2HDP')
        ->ownerName('2 Heures De Perdues')
        ->ownerEmail('2heuresdeperdues@gmail.com')
        ->isExplicit()
        ->isPrivate()
        ->type(ItunesTypeEnum::episodic)
        ->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_film_film_reviews)
        ->addCategory(ItunesCategoryEnum::leisure, ItunesSubCategoryEnum::leisure_hobbies)
        ->addCategory(ItunesCategoryEnum::fiction)
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
        ->title('Movie 1')
        ->link('https://podcast.ausha.co/2-heures-de-perdues/peau-d-ane')
        ->publishDate('2023-06-14 08:39:25')
        ->enclosure(
            url: 'https://chtbl.com/track/47E579/https://audio.ausha.co/B4mpWfDq5KDa.mp3?t=1685693288',
            length: 56898528,
            type: 'audio/mpeg'
        )
        ->episodeType('full')
        ->addChapter(start: '00:00:00', title: 'Chapter 1')
        ->addChapter(start: '00:10:00', title: 'Chapter 2')
        ->addChapter(start: '00:20:00', title: 'Chapter 3');

    $podcast->addItem($item1);
    $podcast->addItem([
        'title' => 'Movie 2',
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
    expect($xml->find('title'))->toBe('2 Heures De Perdues');
    expect($xml->find('atom:link')['@attributes']['href'])->toBe('https://www.2hdp.fr/xml');
    expect($xml->find('link'))->toBe('https://www.2hdp.fr');
    expect($xml->find('description'))->toBe('Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films');
    expect($xml->find('language'))->toBe('fr');
    expect($xml->find('lastBuildDate'))->toBe('Wed, 01 Sep 2021 00:00:00 +0000');
    expect($xml->find('webMaster'))->toBe('feeds@ausha.co (Ausha)');
    expect($xml->find('generator'))->toBe('Ausha (https://www.ausha.co)');
    expect($xml->find('itunes:keywords'))->toBe('films,critiques,comédie');

    expect($xml->find('itunes:author'))->toBe('2HDP');
    expect($xml->find('itunes:owner')['itunes:name'])->toBe('2 Heures De Perdues');
    expect($xml->find('itunes:owner')['itunes:email'])->toBe('2heuresdeperdues@gmail.com');
    expect($xml->find('googleplay:author'))->toBe('2 Heures De Perdues');
    expect($xml->find('googleplay:email'))->toBe('2heuresdeperdues@gmail.com');

    expect($xml->find('itunes:name'))->toBe('2 Heures De Perdues');
    expect($xml->find('itunes:email'))->toBe('2heuresdeperdues@gmail.com');
    expect($xml->find('itunes:explicit'))->toBe('yes');
    expect($xml->find('itunes:block'))->toBe('yes');
    expect($xml->find('itunes:type'))->toBe('episodic');

    $categories = $xml->find('category');
    expect($categories[0])->toBe('TV &amp; Film');
    expect($categories[1])->toBe('Leisure');

    $itunesCategories = $xml->find('itunes:category');
    expect($itunesCategories[0]['@attributes']['text'])->toBe('TV &amp; Film');
    expect($itunesCategories[0]['itunes:category']['@attributes']['text'])->toBe('Film Reviews');
    expect($itunesCategories[1]['@attributes']['text'])->toBe('Leisure');
    expect($itunesCategories[1]['itunes:category']['@attributes']['text'])->toBe('Hobbies');
    expect($xml->find('itunes:image')['@attributes']['href'])->toBe('https://raw.githubusercontent.com/kiwilan/php-rss/main/tests/examples/folder.jpeg');
    expect($xml->find('item'))->toBeArray();
    expect($xml->find('item'))->toHaveCount(3);
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

it('can read enums', function () {
    $categories = ItunesCategoryEnum::toArray();
    $episodeTypes = ItunesEpisodeTypeEnum::toArray();
    $subCategories = ItunesSubCategoryEnum::toArray();
    $types = ItunesTypeEnum::toArray();

    expect($categories)->toBeArray();
    expect($episodeTypes)->toBeArray();
    expect($types)->toBeArray();
    expect($subCategories)->toBeArray();
});

it('can use categories', function () {
    $feed = Feed::make()->podcast()
        ->title('2 Heures De Perdues')
        ->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_film_film_reviews);

    $categories = invade($feed)->categories;

    expect($categories)->toBeArray();
    expect($categories)->toHaveCount(1);
    expect($categories[0][0])->toBeInstanceOf(ItunesCategoryEnum::class);
    expect($categories[0][0])->toBe(ItunesCategoryEnum::tv_film);
    expect($categories[0][1])->toBeInstanceOf(ItunesSubCategoryEnum::class);
    expect($categories[0][1])->toBe(ItunesSubCategoryEnum::tv_film_film_reviews);

    $feed = Feed::make()->podcast()
        ->title('2 Heures De Perdues')
        ->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_film_film_reviews)
        ->addCategory(ItunesCategoryEnum::leisure, ItunesSubCategoryEnum::leisure_hobbies)
        ->addCategory(ItunesCategoryEnum::fiction);

    $categories = invade($feed)->categories;

    expect($categories)->toBeArray();
    expect($categories)->toHaveCount(3);

    $feed = Feed::make()->podcast()
        ->title('2 Heures De Perdues')
        ->addCategory('TV & Film', 'Film Reviews');

    $categories = invade($feed)->categories;
    expect($categories[0][0])->toBe('TV & Film');
    expect($categories[0][1])->toBe('Film Reviews');

    $feed = Feed::make()->podcast()
        ->title('2 Heures De Perdues')
        ->addCategories([
            [
                'category' => ItunesCategoryEnum::tv_film,
                'subCategory' => ItunesSubCategoryEnum::tv_film_film_reviews,
            ],
            [
                'category' => ItunesCategoryEnum::leisure,
                'subCategory' => ItunesSubCategoryEnum::leisure_hobbies,
            ],
            [
                'category' => ItunesCategoryEnum::fiction,
            ],
        ]);

    $categories = invade($feed)->categories;

    expect($categories)->toBeArray();
    expect($categories)->toHaveCount(3);

    $feed = Feed::make()->podcast()
        ->title('2 Heures De Perdues')
        ->addCategories([
            [
                'category' => ItunesCategoryEnum::fiction->value,
            ],
        ]);

    $categories = invade($feed)->categories;

    expect($categories)->toBeArray();
    expect($categories)->toHaveCount(1);
});
