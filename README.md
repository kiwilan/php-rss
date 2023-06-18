# PHP RSS

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

## Installation

You can install the package via composer:

```bash
composer require kiwilan/php-rss
```

## Usage

### Podcast

Podcast RSS feed is quite old and has a lot of different versions. This package is based on the [Podcast namespace](https://podcastnamespace.org/) and the [Apple Podcasts tags](https://help.apple.com/itc/podcasts_connect/#/itcb54353390).

```php
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
$podcast->image('https://raw.githubusercontent.com/kiwilan/php-rss/main/tests/examples/folder.jpeg');

$podcast->get(); // Get XML feed
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
