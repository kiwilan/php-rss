<?php

namespace Kiwilan\Rss\Feeds\Podcast;

use DateTime;
use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesExplicit;
use Kiwilan\Rss\Enums\ItunesSubCategoryEnum;
use Kiwilan\Rss\Enums\ItunesTypeEnum;
use Kiwilan\Rss\Feed;
use Kiwilan\Rss\Feeds\FeedChannel;

class PodcastChannel extends FeedChannel
{
    /**
     * @param  string[]|null  $keywords
     * @param  array<ItunesCategoryEnum,ItunesSubCategoryEnum>|null  $categories
     * @param  PodcastItem[]  $items
     */
    protected function __construct(
        protected Feed $feed,
        protected ?string $title = null, // `title`
        protected ?string $link = null, // `link`
        protected ?string $subtitle = null, // `itunesSubtitle`
        protected ?string $description = null, // `description`, `itunesSummary`, `googleplayDescription`
        protected ?string $language = null, // `language`, `spotifyCountryOfOrigin`
        protected ?string $copyright = null, // `copyright`
        protected ?DateTime $lastUpdate = null, // `lastBuildDate`, `pubDate`
        protected ?string $webmaster = null, // `webMaster`
        protected ?string $generator = null, // `generator`
        protected ?string $guid = null, // `guid`
        protected ?array $keywords = null, // `itunes:keywords`

        protected ?string $authorName = null, // `itunesAuthor`, `googleplayAuthor`, `itunesOwner.name`
        protected ?string $authorEmail = null, // `itunesOwner.email`, `googleplayEmail`

        protected ?ItunesExplicit $explicit = null, // `itunes:explicit`, `googleplay:explicit`
        protected bool $isPrivate = false, // `itunesBlock`, `googleplayBlock`

        protected ?ItunesTypeEnum $type = null, // `itunesType`
        protected ?array $categories = null, // `category`

        protected ?string $image = null, // `image`, `itunesImage`, `googleplayImage`
        protected array $items = [],
    ) {
        parent::__construct($feed);
    }

    public function title(?string $title): self
    {
        $this->title = $title;
        $this->feed->setChannel([
            'title' => $title,
        ]);

        return $this;
    }

    public function link(?string $link): self
    {
        $this->link = $link;
        $this->feed->setChannel([
            'link' => $link,
        ]);

        return $this;
    }

    public function subtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;
        $this->feed->setChannel([
            'itunes:subtitle' => $subtitle,
        ]);

        return $this;
    }

    public function description(?string $description): self
    {
        $this->description = $description;
        $this->feed->setChannel([
            'description' => $description,
            'itunes:summary' => $description,
            'googleplay:description' => $description,
        ]);

        return $this;
    }

    public function language(?string $language): self
    {
        $this->language = $language;
        $this->feed->setChannel([
            'language' => $language,
            'spotify:countryOfOrigin' => $language,
        ]);

        return $this;
    }

    public function copyright(?string $copyright): self
    {
        $this->copyright = $copyright;
        $this->feed->setChannel([
            'copyright' => $copyright,
        ]);

        return $this;
    }

    public function lastUpdate(DateTime|string|null $lastUpdate): self
    {
        if (is_string($lastUpdate)) {
            $lastUpdate = new DateTime($lastUpdate);
        }

        $this->lastUpdate = $lastUpdate;
        $this->feed->setChannel([
            'lastBuildDate' => $lastUpdate->format(DateTime::RSS),
            'pubDate' => $lastUpdate->format(DateTime::RSS),
        ]);

        return $this;
    }

    public function webmaster(?string $webmaster): self
    {
        $this->webmaster = $webmaster;
        $this->feed->setChannel([
            'webMaster' => $webmaster,
        ]);

        return $this;
    }

    public function generator(?string $generator): self
    {
        $this->generator = $generator;
        $this->feed->setChannel([
            'generator' => $generator,
        ]);

        return $this;
    }

    public function guid(?string $guid): self
    {
        $this->guid = $guid;
        $this->feed->setChannel([
            'guid' => $guid,
        ]);

        return $this;
    }

    public function keywords(?array $keywords): self
    {
        if (! $keywords) {
            return $this;
        }

        $this->keywords = $keywords;
        $this->feed->setChannel([
            'itunes:keywords' => implode(',', $keywords),
        ]);

        return $this;
    }

    public function author(string $name, ?string $email = null): self
    {
        if (! $name && ! $email) {
            return $this;
        }

        $this->authorName = $name;
        $this->authorEmail = $email;

        $this->feed->setChannel([
            'dc:creator' => [
                '_attributes' => [
                    'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
                ],
                '_value' => $name,
            ],
            'itunes:author' => $name,
            'itunes:owner' => [
                'itunes:name' => $name,
                'itunes:email' => $email,
            ],
            'googleplay:author' => $name,
            'googleplay:email' => $email,
        ]);

        return $this;
    }

    public function explicit(ItunesExplicit $explicit): self
    {
        $this->explicit = $explicit;
        $this->feed->setChannel([
            'itunes:explicit' => $explicit->value,
            'googleplay:explicit' => $explicit->value,
        ]);

        return $this;
    }

    public function isPrivate(): self
    {
        $this->isPrivate = true;
        $this->feed->setChannel([
            'itunes:block' => 'Yes',
            'googleplay:block' => 'Yes',
        ]);

        return $this;
    }

    public function type(ItunesTypeEnum $type): self
    {
        $this->type = $type;
        $this->feed->setChannel([
            'itunes:type' => $type->value,
        ]);

        return $this;
    }

    public function addCategory(ItunesCategoryEnum $category, ?ItunesSubCategoryEnum $subCategory = null): self
    {
        $size = 1;
        if ($this->categories) {
            $size = count($this->categories) + 1;
        }

        $this->categories[] = [
            $category,
            $subCategory,
        ];

        $categoryData = [
            '__custom:category:'.$size => $category->value,
        ];

        $itunesKey = '__custom:itunes\\:category:'.$size;
        $categoryData[$itunesKey] = [
            '_attributes' => [
                'text' => $category->value,
            ],
        ];

        if ($subCategory) {
            $categoryData[$itunesKey]['itunes:category'] = [
                '_attributes' => [
                    'text' => $subCategory->value,
                ],
            ];
        }

        $this->feed->setChannel($categoryData);

        return $this;
    }

    /**
     * Set image for podcast, must be set after `title` and `link`.
     */
    public function image(?string $image): self
    {
        if (! $image) {
            return $this;
        }

        $this->image = $image;
        $this->feed->setChannel([
            'image' => [
                'url' => $image,
                'title' => $this->title,
                'link' => $this->link,
            ],
            'itunes:image' => [
                '_attributes' => [
                    'href' => $image,
                ],
            ],
            'googleplay:image' => [
                '_attributes' => [
                    'href' => $image,
                ],
            ],
        ]);

        return $this;
    }

    public function addItem(PodcastItem|array $item): self
    {
        if (is_array($item)) {
            $enclosure = $item['enclosure'] ?? null;
            if ($enclosure) {
                $enclosureUrl = $enclosure['url'] ?? null;
                $enclosureLength = $enclosure['length'] ?? null;
                $enclosureType = $enclosure['type'] ?? null;
            }
            $item = PodcastItem::make()
                ->title($item['title'] ?? null)
                ->guid($item['guid'] ?? null)
                ->subtitle($item['subtitle'] ?? null)
                ->description($item['description'] ?? null)
                ->publishDate($item['publishDate'] ?? null)
                ->enclosure($enclosureUrl, $enclosureLength, $enclosureType)
                ->link($item['link'] ?? null)
                ->author($item['author'] ?? null)
                ->keywords($item['keywords'] ?? null)
                ->duration($item['duration'] ?? null)
                ->episodeType($item['episodeType'] ?? null)
                ->season($item['season'] ?? null)
                ->episode($item['episode'] ?? null)
                ->isExplicit($item['isExplicit'] ?? null)
                ->image($item['image'] ?? null);
        }

        $this->items[] = $item;
        $this->feed->setItem($item->get());

        return $this;
    }
}
