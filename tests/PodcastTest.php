<?php

use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesExplicit;
use Kiwilan\Rss\Enums\ItunesSubCategoryEnum;
use Kiwilan\Rss\Enums\ItunesTypeEnum;
use Kiwilan\Rss\Feed;
use Kiwilan\Rss\Tests\Utils\XmlReader;

it('can make podcast feed', function () {
    $podcast = Feed::make()->podcast();
    $podcast->title('2 Heures De Perdues');
    $podcast->link('https://www.2hdp.fr');
    $podcast->subtitle('Pourquoi gagner du temps quand on peut en perdre devant de mauvais films ?');
    $podcast->description('Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films');
    $podcast->language('fr');
    $podcast->copyright('℗ & © 2019 Fréquence Moderne');
    $podcast->lastUpdate(new DateTime('2021-09-01 00:00:00'));
    $podcast->webmaster('feeds@ausha.co (Ausha)');
    $podcast->generator('Ausha (https://www.ausha.co)');
    $podcast->keywords(['films', 'critiques', 'comédie']);
    $podcast->author('2 Heures De Perdues', '2heuresdeperdues@gmail.com');
    $podcast->explicit(ItunesExplicit::yes);
    $podcast->isPrivate();
    $podcast->type(ItunesTypeEnum::episodic);
    $podcast->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_films_film_reviews);
    $podcast->addCategory(ItunesCategoryEnum::leisure, ItunesSubCategoryEnum::leisure_hobbies);
    $podcast->image('https://raw.githubusercontent.com/kiwilan/php-rss/main/tests/examples/folder.jpeg');

    foreach (ITEMS as $item) {
        $podcast->addItem($item);
    }

    $podcast->get();

    $path = OUTPUT.'/feed-podcast.xml';
    $podcast->save($path);

    $xml = file_get_contents($path);
    $reader = XmlReader::make($xml);
    $content = $reader->content();

    $channel = $content['channel'];

    expect($content['@root'])->toBe('rss');
    expect($channel['title'])->toBe('2 Heures De Perdues');
    expect($channel['link'])->toBe('https://www.2hdp.fr');
    expect($channel['description'])->toBe('Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films');
    expect($channel['language'])->toBe('fr');
    expect($channel['lastBuildDate'])->toBe('Wed, 01 Sep 2021 00:00:00 +0000');
    expect($channel['webMaster'])->toBe('feeds@ausha.co (Ausha)');
    expect($channel['generator'])->toBe('Ausha (https://www.ausha.co)');
    expect($channel['itunes:keywords'])->toBe('films,critiques,comédie');
    expect($channel['itunes:author'])->toBe('2 Heures De Perdues');
    expect($channel['itunes:owner']['itunes:name'])->toBe('2 Heures De Perdues');
    expect($channel['itunes:owner']['itunes:email'])->toBe('2heuresdeperdues@gmail.com');
    expect($channel['itunes:explicit'])->toBe('yes');
    expect($channel['itunes:block'])->toBe('Yes');
    expect($channel['itunes:type'])->toBe('episodic');

    expect($channel['category'][0])->toBe('TV &amp; Film');
    expect($channel['category'][1])->toBe('Leisure');
    expect($channel['itunes:category'][0]['@attributes']['text'])->toBe('TV &amp; Film');
    expect($channel['itunes:category'][0]['itunes:category']['@attributes']['text'])->toBe('Film Reviews');
    expect($channel['itunes:category'][1]['@attributes']['text'])->toBe('Leisure');
    expect($channel['itunes:category'][1]['itunes:category']['@attributes']['text'])->toBe('Hobbies');
    expect($channel['itunes:image']['@attributes']['href'])->toBe('https://raw.githubusercontent.com/kiwilan/php-rss/main/tests/examples/folder.jpeg');
    expect($channel['item'])->toBeArray();
    expect($channel['item'])->toHaveCount(2);
});
