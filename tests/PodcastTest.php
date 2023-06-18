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
    // $podcast->isPrivate(false);
    $podcast->type(ItunesTypeEnum::episodic);
    $podcast->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_films_film_reviews);
    $podcast->image('https://raw.githubusercontent.com/kiwilan/php-rss/main/tests/examples/folder.jpeg');

    foreach (ITEMS as $item) {
        $podcast->addItem($item);
    }

    $podcast->get();
    $podcast->save(OUTPUT.'/feed-podcast.xml');

    ray($podcast);

    $reader = XmlReader::make(OUTPUT.'/feed-podcast.xml');
    ray($reader);
});
