<?php

namespace Kiwilan\Rss\Feeds\Podcast;

use DateTime;

class PodcastItem
{
    // `description`: A short description of your episode. This will be used if <itunes:summary> is missing
    // `content:encoded`: The full show notes
    // `itunes:keywords`: Deprecated by Apple, but some platforms actually still use this
    // `itunes:subtitle`: Displays only in iTunes in episode listings
    // `itunes:summary`: One- or two-sentence summary of the episode, displays when pressing (i) button in iTunes, displays in iOS 11 along with title and show notes
    protected function __construct(
        protected ?string $title = null, // `title`
        protected ?string $guid = null, // `guid`
        protected ?string $subtitle = null, // `itunes:subtitle`
        protected ?string $description = null, // `description`, `content:encoded`
        protected ?DateTime $publishDate = null, // `pubDate`
        protected ?string $enclosure = null, // `enclosure`
        protected ?string $link = null, // `link`
        protected ?string $author = null, // `itunes:author`, `googleplay:author`
        protected ?string $keywords = null, // `itunes:keywords`
        protected ?int $duration = null, // `itunes:duration`
        protected ?string $episodeType = null, // `itunes:episodeType` (Episode type: “full,” “trailer,” or “bonus”)
        protected ?int $season = null, // `itunes:season`
        protected ?int $episode = null, // `itunes:episode`
        protected bool $isExplicit = false, // `itunes:explicit`, `googleplay:explicit`
        protected ?string $image = null, // `itunes:image`, `googleplay:image`
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

    public function guid(string $guid): self
    {
        $this->guid = $guid;

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

    public function publishDate(DateTime $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function enclosure(string $enclosure): self
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    public function link(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function author(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function keywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function duration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function episodeType(string $episodeType): self
    {
        $this->episodeType = $episodeType;

        return $this;
    }

    public function season(string $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function episode(string $episode): self
    {
        $this->episode = $episode;

        return $this;
    }

    public function isExplicit(): self
    {
        $this->isExplicit = true;

        return $this;
    }

    public function image(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function get(): array
    {
        return [
            'title' => $this->title,
            'guid' => $this->guid,
            'itunes:subtitle' => $this->subtitle,
            'description' => $this->description,
            'pubDate' => $this->publishDate,
            'enclosure' => $this->enclosure,
            'link' => $this->link,
            'itunes:author' => $this->author,
            'itunes:keywords' => $this->keywords,
            'itunes:duration' => $this->duration,
            'itunes:episodeType' => $this->episodeType,
            'itunes:season' => $this->season,
            'itunes:episode' => $this->episode,
            'itunes:explicit' => $this->isExplicit,
            'itunes:image' => $this->image,
        ];
    }
}
