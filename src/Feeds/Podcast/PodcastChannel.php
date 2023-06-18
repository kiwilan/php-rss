<?php

namespace Kiwilan\Rss\Feeds\Podcast;

use DateTime;
use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesSubCategoryEnum;
use Kiwilan\Rss\Enums\ItunesTypeEnum;

/**
 * @docs https://podcasters.apple.com/support/1691-apple-podcasts-categories
 * @docs https://castos.com/podcast-rss-feed/
 * @docs iTunes: https://www.podcastersroundtable.com/pm17/
 */
class PodcastChannel
{
    /**
     * @param  string[]|null  $keywords
     */
    protected function __construct(
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

        protected bool $isExplicit = false, // `itunesExplicit`, `googleplayExplicit`
        protected bool $isPrivate = false, // `itunesBlock`, `googleplayBlock`

        protected ?ItunesTypeEnum $type = null, // `itunesType`
        protected ?ItunesCategoryEnum $category = null, // `category`
        protected ?ItunesSubCategoryEnum $subCategory = null, // `itunesCategory`

        protected ?string $image = null, // `image`, `itunesImage`, `googleplayImage`
    ) {
    }

    public static function make()
    {
        return new self();
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function link(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function subtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function language(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function copyright(string $copyright): self
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function lastUpdate(DateTime|string $lastUpdate): self
    {
        if (is_string($lastUpdate)) {
            $lastUpdate = new DateTime($lastUpdate);
        }

        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function webmaster(string $webmaster): self
    {
        $this->webmaster = $webmaster;

        return $this;
    }

    public function generator(string $generator): self
    {
        $this->generator = $generator;

        return $this;
    }

    public function keywords(array $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function authorName(string $name): self
    {
        $this->authorName = $name;

        return $this;
    }

    public function authorEmail(string $email): self
    {
        $this->authorEmail = $email;

        return $this;
    }

    public function isExplicit(): self
    {
        $this->isExplicit = true;

        return $this;
    }

    public function isPrivate(): self
    {
        $this->isPrivate = true;

        return $this;
    }

    public function type(ItunesTypeEnum $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function category(ItunesCategoryEnum $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function subCategory(ItunesSubCategoryEnum $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    public function image(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
