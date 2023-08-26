# PHP RSS

![Banner with abstract data picture in background and PHP RSS title](https://raw.githubusercontent.com/kiwilan/php-rss/main/docs/banner.jpg)

[![php][php-version-src]][php-version-href]
[![version][version-src]][version-href]
[![downloads][downloads-src]][downloads-href]
[![license][license-src]][license-href]
[![tests][tests-src]][tests-href]
[![codecov][codecov-src]][codecov-href]

> **Warning**
>
> NOT READY FOR PRODUCTION

PHP package to generate RSS feeds with presets.

|  Type   | Supported |          With          |
| :-----: | :-------: | :--------------------: |
| Podcast |    ✅     | `itunes`, `googleplay` |
|   Raw   |    ✅     |                        |

## Features

// TODO

### Roadmap

-   [ ] Add JSON feed from <https://github.com/bcomnes/jsonfeed-to-rss>
-   [ ] Add blog feed
-   [ ] Add atom option

## Installation

You can install the package via composer:

```bash
composer require kiwilan/php-rss
```

## Usage

### Podcast

Podcast RSS feed is quite old and has a lot of different versions.

-   [Podcast namespace](https://podcastnamespace.org/)
-   [Apple Podcasts](https://help.apple.com/itc/podcasts_connect/#/itcb54353390)
-   [Google Podcasts](https://support.google.com/podcast-publishers/answer/9889544?hl=en)

```php
$podcast = Feed::make()->podcast()
  ->title('2 Heures De Perdues')
  ->link('https://www.2hdp.fr')
  ->atomLink('https://www.2hdp.fr/xml')
  ->subtitle('Pourquoi gagner du temps quand on peut en perdre devant de mauvais films ?')
  ->description('Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films')
  ->language('fr')
  ->copyright('℗ & © 2019 Fréquence Moderne')
  ->lastUpdate(new DateTime('2021-09-01 00:00:00'))
  ->webmaster('feeds@ausha.co (Ausha)')
  ->generator('Ausha (https://www.ausha.co)')
  ->keywords(['films', 'critiques', 'comédie'])
  ->author('2HDP')
  ->ownerName('2 Heures De Perdues')
  ->ownerEmail('2heuresdeperdues@gmail.com')
  ->isExplicit()
  ->isPrivate()
  ->type(ItunesTypeEnum::episodic)
  ->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_films_film_reviews)
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
  ->isNotExplicit()
  ->image('https://image.ausha.co/XboDHYC69Oorw8MBObAkQ2sTPdxGTkexH3nYQ8Ky_1400x1400.jpeg?t=1619074925');

$podcast->addItem($item1); // Add item to podcast
$podcast->get(); // Get XML feed
```

### Raw

> _Note_
>
> You can use [`spatie/array-to-xml`](https://github.com/spatie/array-to-xml#using-custom-keys) usage guide to help you.

```php
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
```

### Example with Laravel

```php
<?php

namespace App\Http\Controllers;

use DateTime;
use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesExplicitEnum;
use Kiwilan\Rss\Enums\ItunesSubCategoryEnum;
use Kiwilan\Rss\Enums\ItunesTypeEnum;
use Kiwilan\Rss\Feed;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('rss')]
class RssController extends Controller
{
    #[Get('/')]
    public function index()
    {
        $podcast = Feed::make()->podcast()
            ->title('2 Heures De Perdues')
            ->link('https://www.2hdp.fr')
            ->subtitle('Pourquoi gagner du temps quand on peut en perdre devant de mauvais films ?')
            ->description('Petit podcast de rigolos pour les amateurs de cinéma. Pourquoi gagner du temps quand on peut en perdre devant de mauvais films')
            ->language('fr')
            ->copyright('℗ & © 2019 Fréquence Moderne')
            ->lastUpdate(new DateTime('2021-09-01 00:00:00'))
            ->webmaster('feeds@ausha.co (Ausha)')
            ->generator('Ausha (https://www.ausha.co)')
            ->keywords(['films', 'critiques', 'comédie'])
            ->author('2 Heures De Perdues', '2heuresdeperdues@gmail.com')
            ->explicit(ItunesExplicitEnum::yes)
            ->isPrivate()
            ->type(ItunesTypeEnum::episodic)
            ->addCategory(ItunesCategoryEnum::tv_film, ItunesSubCategoryEnum::tv_films_film_reviews)
            ->image('https://raw.githubusercontent.com/kiwilan/php-rss/main/tests/examples/folder.jpeg')
        ;

        return response($podcast->get(), 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
```

## Testing

```bash
composer test
```

## Resources

### Specifications

-   [Podcast namespace](https://podcastnamespace.org/)
-   [Apple Podcasts](https://help.apple.com/itc/podcasts_connect/#/itcb54353390)
-   [Google Podcasts](https://support.google.com/podcast-publishers/answer/9889544?hl=en)
-   [Apple Podcasts categories](https://podcasters.apple.com/support/1691-apple-podcasts-categories)
-   [gPodder](https://github.com/gpodder/podcast-feed-best-practice/blob/master/podcast-feed-best-practice.md)
-   [Podcasters' Roundtable](https://www.podcastersroundtable.com/pm17/)
-   [Podbean](https://help.podbean.com/support/solutions/articles/25000010756-how-to-set-ios11-itunes-feed-tags-in-your-podcast)

### RSS validator

-   <https://www.castfeedvalidator.com>
-   <https://podba.se/validate>

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

-   [`spatie`](https://github.com/spatie) for `spatie/package-skeleton-php` and `spatie/array-to-xml`

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[<img src="https://user-images.githubusercontent.com/48261459/201463225-0a5a084e-df15-4b11-b1d2-40fafd3555cf.svg" height="120rem" width="100%" />](https://github.com/kiwilan)

[version-src]: https://img.shields.io/packagist/v/kiwilan/php-rss.svg?style=flat-square&colorA=18181B&colorB=777BB4
[version-href]: https://packagist.org/packages/kiwilan/php-rss
[php-version-src]: https://img.shields.io/static/v1?style=flat-square&label=PHP&message=v8.1&color=777BB4&logo=php&logoColor=ffffff&labelColor=18181b
[php-version-href]: https://www.php.net/
[downloads-src]: https://img.shields.io/packagist/dt/kiwilan/php-rss.svg?style=flat-square&colorA=18181B&colorB=777BB4
[downloads-href]: https://packagist.org/packages/kiwilan/php-rss
[license-src]: https://img.shields.io/github/license/kiwilan/php-rss.svg?style=flat-square&colorA=18181B&colorB=777BB4
[license-href]: https://github.com/kiwilan/php-rss/blob/main/README.md
[tests-src]: https://img.shields.io/github/actions/workflow/status/kiwilan/php-rss/run-tests.yml?branch=main&label=tests&style=flat-square&colorA=18181B
[tests-href]: https://packagist.org/packages/kiwilan/php-rss
[codecov-src]: https://codecov.io/gh/kiwilan/php-rss/branch/main/graph/badge.svg?token=mAcu8oCEM9
[codecov-href]: https://codecov.io/gh/kiwilan/php-rss
