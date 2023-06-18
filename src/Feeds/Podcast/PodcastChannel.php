<?php

namespace Kiwilan\Rss\Feeds\Podcast;

use DateTime;
use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesExplicit;
use Kiwilan\Rss\Enums\ItunesSubCategoryEnum;
use Kiwilan\Rss\Enums\ItunesTypeEnum;
use Kiwilan\Rss\Feed;
use Kiwilan\Rss\Feeds\FeedChannel;

/**
 * @docs https://podcasters.apple.com/support/1691-apple-podcasts-categories
 * @docs https://castos.com/podcast-rss-feed/
 * @docs iTunes: https://www.podcastersroundtable.com/pm17/
 */
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

    public function title(string $title): self
    {
        $this->title = $title;
        $this->feed->setChannel([
            'title' => $title,
        ]);

        return $this;
    }

    public function link(string $link): self
    {
        $this->link = $link;
        $this->feed->setChannel([
            'link' => $link,
        ]);

        return $this;
    }

    public function subtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;
        $this->feed->setChannel([
            'itunes:subtitle' => $subtitle,
        ]);

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;
        $this->feed->setChannel([
            'description' => $description,
            'itunes:summary' => $description,
            'googleplay:description' => $description,
        ]);

        return $this;
    }

    public function language(string $language): self
    {
        $this->language = $language;
        $this->feed->setChannel([
            'language' => $language,
            'spotify:countryOfOrigin' => $language,
        ]);

        return $this;
    }

    public function copyright(string $copyright): self
    {
        $this->copyright = $copyright;
        $this->feed->setChannel([
            'copyright' => $copyright,
        ]);

        return $this;
    }

    public function lastUpdate(DateTime|string $lastUpdate): self
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

    public function webmaster(string $webmaster): self
    {
        $this->webmaster = $webmaster;
        $this->feed->setChannel([
            'webMaster' => $webmaster,
        ]);

        return $this;
    }

    public function generator(string $generator): self
    {
        $this->generator = $generator;
        $this->feed->setChannel([
            'generator' => $generator,
        ]);

        return $this;
    }

    public function keywords(array $keywords): self
    {
        $this->keywords = $keywords;
        $this->feed->setChannel([
            'itunes:keywords' => implode(',', $keywords),
        ]);

        return $this;
    }

    public function authorName(string $name): self
    {
        $this->authorName = $name;
        $this->feed->setChannel([
            'itunes:author' => $name,
            'googleplay:author' => $name,
            'itunes:owner.name' => $name,
        ]);

        return $this;
    }

    public function authorEmail(string $email): self
    {
        $this->authorEmail = $email;
        $this->feed->setChannel([
            'itunes:owner.email' => $email,
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
        $this->categories[] = [
            $category,
            $subCategory,
        ];
        $this->feed->setChannel([
            'category' => [
                '_attributes' => [
                    'text' => $category->value,
                ],
                'itunes:category' => [
                    '_attributes' => [
                        'text' => $subCategory?->value,
                    ],
                ],
            ],
        ]);

        return $this;
    }

    public function image(string $image): self
    {
        $this->image = $image;
        $this->feed->setChannel([
            'image' => $image,
            'itunes:image' => $image,
            'googleplay:image' => $image,
        ]);

        return $this;
    }

    public function addItem(PodcastItem $item): self
    {
        $this->items[] = $item;
        $this->feed->setChannel([
            'item' => $item->get(),
        ]);

        return $this;
    }
}
