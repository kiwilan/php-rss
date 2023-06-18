<?php

use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesExplicit;
use Kiwilan\Rss\Enums\ItunesSubCategoryEnum;
use Kiwilan\Rss\Enums\ItunesTypeEnum;
use Kiwilan\Rss\Feed;

it('can make podcast feed', function () {
    $feed = Feed::make();
    $podcast = $feed->podcast();
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
    $podcast->authorName('2 Heures De Perdues');
    $podcast->authorEmail('2heuresdeperdues@gmail.com');
    $podcast->explicit(ItunesExplicit::yes);
    $podcast->isPrivate(false);
    $podcast->type(ItunesTypeEnum::episodic);
    $podcast->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_films_film_reviews);
    $podcast->image('tests/examples/folder.jpeg');

    $podcast->get();
    $podcast->save(OUTPUT.'/feed-podcast.xml');

    ray($podcast);
});
