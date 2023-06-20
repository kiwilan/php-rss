<?php

use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesEpisodeTypeEnum;
use Kiwilan\Rss\Enums\ItunesExplicit;
use Kiwilan\Rss\Enums\ItunesSubCategoryEnum;
use Kiwilan\Rss\Enums\ItunesTypeEnum;
use Kiwilan\Rss\Feed;
use Kiwilan\Rss\Feeds\Podcast\PodcastChannel;
use Kiwilan\Rss\Feeds\Podcast\PodcastItem;

define('OUTPUT', __DIR__.'/output');
define('EXAMPLES', __DIR__.'/examples');

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
    ->keywords([])
    ->duration(3551)
    ->episodeType(ItunesEpisodeTypeEnum::full)
    ->season(9)
    ->episode(34)
    ->isExplicit(false)
    ->image('https://image.ausha.co/XboDHYC69Oorw8MBObAkQ2sTPdxGTkexH3nYQ8Ky_1400x1400.jpeg?t=1619074925');

$item2 = PodcastItem::make()
    ->title('Les Dents de la Mer')
    ->subtitle('On discute du chef d\'oeuvre de Steven. Des réactions ? @2_HDP')
    ->description('<p>On discute du chef d\'oeuvre de Steven. Des réactions ? @2_HDP</p>')
    ->publishDate(new DateTime('2023-06-07 14:19:12'))
    ->enclosure(
        url: 'https://chtbl.com/track/47E579/https://audio.ausha.co/bWKZWTDW75RR.mp3?t=1685692067',
        length: 73226104,
        type: 'audio/mpeg',
    )
    ->link('https://podcast.ausha.co/2-heures-de-perdues/les-dents-de-la-mer')
    ->author('2 Heures de Perdues')
    ->keywords([])
    ->duration(4571)
    ->episodeType(ItunesEpisodeTypeEnum::full)
    ->season(9)
    ->episode(33)
    ->isExplicit(false)
    ->image('https://image.ausha.co/XboDHYC69Oorw8MBObAkQ2sTPdxGTkexH3nYQ8Ky_1400x1400.jpeg?t=1619074925');

define('PODCAST', $podcast);
define('ITEM1', $item1);
define('ITEM2', $item2);

function getPodcastChannel(): PodcastChannel
{
    return PODCAST;
}
