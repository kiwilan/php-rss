# PHP RSS

![Banner with abstract data picture in background and PHP RSS title](docs/banner.jpg)

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

## Installation

You can install the package via composer:

```bash
composer require kiwilan/php-rss
```

## Usage

### Podcast

Podcast RSS feed is quite old and has a lot of different versions. This package is based on the [Podcast namespace](https://podcastnamespace.org/) and the [Apple Podcasts tags](https://help.apple.com/itc/podcasts_connect/#/itcb54353390).

```php
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
  ->explicit(ItunesExplicit::yes)
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
  ->isExplicit(false)
  ->image('https://image.ausha.co/XboDHYC69Oorw8MBObAkQ2sTPdxGTkexH3nYQ8Ky_1400x1400.jpeg?t=1619074925');

$podcast->addItem($item1); // Add item to podcast
$podcast->get(); // Get XML feed
```

### Raw

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

## Testing

```bash
composer test
```

## Resources

-   <https://www.wakdev.com/fr/more/wiki/php-mysql/generation-dun-flux-rss-en-php.html>
-   <https://podcasters.apple.com/support/1691-apple-podcasts-categories>
-   <https://www.podcastersroundtable.com/pm17/>
-   <https://www.castfeedvalidator.com/validate.php>
-   <https://help.podbean.com/support/solutions/articles/25000010756-how-to-set-ios11-itunes-feed-tags-in-your-podcast>
-   <https://castos.com/podcast-rss-feed/>
-   <https://validator.livewire.io/>
-   <https://podcastnamespace.org/>
-   <https://help.apple.com/itc/podcasts_connect/#/itcb54353390>
-   <https://support.google.com/podcast-publishers/answer/9889544?visit_id=638227134075061333-1333811411&rd=1>

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
