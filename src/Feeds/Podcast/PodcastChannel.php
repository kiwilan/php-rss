<?php

namespace Kiwilan\Rss\Feeds\Podcast;

use DateTime;
use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesLanguageEnum;
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
        protected ?string $atomLink = null, // `atom:link`
        protected ?string $subtitle = null, // `itunes:subtitle`
        protected ?string $description = null, // `description`, `itunes:summary`, `googleplay:description`
        protected ItunesLanguageEnum|string|null $language = null, // `language`, `spotify:countryOfOrigin`
        protected ?string $copyright = null, // `copyright`
        protected ?DateTime $lastUpdate = null, // `lastBuildDate`, `pubDate`
        protected ?string $webmaster = null, // `webMaster`
        protected ?string $generator = null, // `generator`
        protected ?string $guid = null, // `guid`
        protected ?array $keywords = null, // `itunes:keywords`

        protected ?string $author = null, // `dc:creator`, `itunes:author`, `googleplay:author`
        protected ?string $ownerName = null, // `itunes:owner.name`
        protected ?string $ownerEmail = null, // `itunes:owner.email`, `googleplay:email`

        protected bool $isExplicit = false, // `itunes:explicit`, `googleplay:explicit`
        protected bool $isPrivate = false, // `itunesBlock`, `googleplayBlock`

        protected ?ItunesTypeEnum $type = null, // `itunesType`
        protected int $categoryIndex = 0,
        protected ?array $categories = null, // `category`

        protected ?string $image = null, // `image`, `itunes:image`, `googleplay:image`

        protected ?string $newFeedUrl = null, // `itunes:new-feed-url`

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

    public function atomLink(?string $link): self
    {
        $this->atomLink = $link;
        $this->feed->setChannel([
            'atom:link' => [
                '_attributes' => [
                    'href' => $link,
                    'rel' => 'self',
                    'type' => 'application/rss+xml',
                ],
            ],
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

    public function language(ItunesLanguageEnum|string|null $language): self
    {
        $this->language = $language;

        if ($language instanceof ItunesLanguageEnum) {
            $language = $language->codeLower();
        }

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

    public function author(string $name): self
    {
        if (! $name) {
            return $this;
        }

        $this->author = $name;

        $this->feed->setChannel([
            'dc:creator' => [
                '_attributes' => [
                    'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
                ],
                '_value' => $name,
            ],
            'itunes:author' => $name,
        ]);

        return $this;
    }

    public function ownerName(string $name): self
    {
        if (! $name) {
            return $this;
        }

        $this->ownerName = $name;

        $this->feed->setChannel([
            'itunes:owner' => [
                ...$this->feed->channel()['itunes:owner'] ?? [],
                'itunes:name' => $name,
            ],
            'googleplay:author' => $name,
        ]);

        return $this;
    }

    public function ownerEmail(string $email): self
    {
        if (! $email) {
            return $this;
        }

        $this->ownerEmail = $email;

        $this->feed->setChannel([
            'itunes:owner' => [
                ...$this->feed->channel()['itunes:owner'] ?? [],
                'itunes:email' => $email,
            ],
            'googleplay:email' => $email,
        ]);

        return $this;
    }

    public function isExplicit(): self
    {
        $this->isExplicit = true;
        $this->feed->setChannel([
            'itunes:explicit' => 'yes',
            'googleplay:explicit' => 'yes',
        ]);

        return $this;
    }

    public function isNotExplicit(): self
    {
        $this->isExplicit = false;
        $this->feed->setChannel([
            'itunes:explicit' => 'no',
            'googleplay:explicit' => 'no',
        ]);

        return $this;
    }

    public function isPrivate(): self
    {
        $this->isPrivate = true;
        $this->feed->setChannel([
            'itunes:block' => 'yes',
            'googleplay:block' => 'yes',
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

    /**
     * Add multiple categories from array.
     *
     * @param  array<array{category:string,subCategory:string}>  $categories
     */
    public function addCategories(array $categories, string $main = 'category', string $secondary = 'subCategory'): self
    {
        foreach ($categories as $key => $value) {
            if (! array_key_exists($main, $value)) {
                continue;
            }

            if ($value[$main] instanceof ItunesCategoryEnum) {
                $this->addCategory($value[$main], $value[$secondary] ?? null);

                continue;
            }

            $enum = ItunesCategoryEnum::fromKey($value[$main], throwException: false);
            $subEnum = null;

            if (! $enum) {
                $this->addCategoryString($value[$main], $value[$secondary] ?? null);

                continue;
            }

            if (array_key_exists($secondary, $value)) {
                $subEnum = ItunesSubCategoryEnum::fromKey($value[$secondary]);
            }

            $this->addCategory($enum, $subEnum);
        }

        return $this;
    }

    /**
     * Add a category.
     *
     * @param  ItunesCategoryEnum|string  $category The main category, example: `TV & Film`
     * @param  ItunesSubCategoryEnum|string|null  $subCategory The sub category, linked to the main category, example: `Film Reviews`
     *
     * @docs https://podcasters.apple.com/support/1691-apple-podcasts-categories
     */
    public function addCategory(ItunesCategoryEnum|string $category, ItunesSubCategoryEnum|string $subCategory = null): self
    {
        if (gettype($category) === 'string' && gettype($subCategory) === 'string') {
            $this->addCategoryString($category, $subCategory);

            return $this;
        }

        $this->categories[] = [
            $category,
            $subCategory,
        ];

        $value = $category->value;
        $value = str_replace('&', '&amp;', $value);

        $categoryData = [
            '__custom:category:'.$this->categoryIndex => $value,
        ];

        $itunesKey = '__custom:itunes\\:category:'.$this->categoryIndex;
        $categoryData[$itunesKey] = [
            '_attributes' => [
                'text' => $value,
            ],
        ];

        if ($subCategory) {
            $subValue = $subCategory->value;
            $subValue = str_replace('&', '&amp;', $subValue);
            $categoryData[$itunesKey]['itunes:category'] = [
                '_attributes' => [
                    'text' => $subValue,
                ],
            ];
        }

        $this->feed->setChannel($categoryData);
        $this->categoryIndex++;

        return $this;
    }

    private function addCategoryString(string $category, string $subCategory = null): self
    {
        $this->categories[] = [
            $category,
            $subCategory,
        ];

        $value = $category;
        $value = str_replace('&', '&amp;', $value);

        $categoryData = [
            '__custom:category:'.$this->categoryIndex => $value,
        ];

        $itunesKey = '__custom:itunes\\:category:'.$this->categoryIndex;
        $categoryData[$itunesKey] = [
            '_attributes' => [
                'text' => $value,
            ],
        ];

        if ($subCategory) {
            $subValue = $subCategory;
            $subValue = str_replace('&', '&amp;', $subValue);
            $categoryData[$itunesKey]['itunes:category'] = [
                '_attributes' => [
                    'text' => $subValue,
                ],
            ];
        }

        $this->feed->setChannel($categoryData);
        $this->categoryIndex++;

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

    /**
     * Set new feed url for podcast, for `itunes:new-feed-url`.
     */
    public function newFeedUrl(?string $newFeedUrl): self
    {
        if (! $newFeedUrl) {
            return $this;
        }

        $this->newFeedUrl = $newFeedUrl;
        $this->feed->setChannel([
            'itunes:new-feed-url' => $newFeedUrl,
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
