<?php

namespace Kiwilan\Rss\Feeds\Podcast;

use DateTime;
use Exception;
use Kiwilan\Rss\Enums\ItunesEpisodeTypeEnum;

class PodcastItem
{
    /**
     * @param  string[]|null  $keywords
     */
    protected function __construct(
        protected ?string $title = null, // `title`
        protected ?string $guid = null, // `guid`
        protected ?string $subtitle = null, // `itunes:subtitle`
        protected ?string $description = null, // `description`, `content:encoded`
        protected ?DateTime $publishDate = null, // `pubDate`
        protected ?PodcastEnclosure $enclosure = null, // `enclosure`
        protected ?string $link = null, // `link`
        protected ?string $author = null, // `itunes:author`, `googleplay:author`
        protected ?array $keywords = null, // `itunes:keywords`
        protected ?int $duration = null, // `itunes:duration`
        protected ItunesEpisodeTypeEnum $episodeType = ItunesEpisodeTypeEnum::full, // `itunes:episodeType`
        protected ?int $season = null, // `itunes:season`
        protected ?int $episode = null, // `itunes:episode`
        protected bool $isExplicit = false, // `itunes:explicit`, `googleplay:explicit`
        protected ?string $image = null, // `itunes:image`, `googleplay:image`
        protected array $item = [],
    ) {
    }

    public static function make()
    {
        return new self();
    }

    public function title(?string $title): self
    {
        if (! $title) {
            return $this;
        }

        $this->title = $title;
        $this->item['title'] = $title;

        return $this;
    }

    /**
     * Unique identifier for the episode, optional, can be auto-generated.
     */
    public function guid(?string $guid, bool $isPermaLink = false): self
    {
        if (! $guid) {
            return $this;
        }

        $this->guid = $guid;
        $this->item['guid'] = [
            '_attributes' => [
                'isPermaLink' => $isPermaLink ? 'true' : 'false',
            ],
            '_value' => $guid,
        ];

        return $this;
    }

    public function subtitle(?string $subtitle): self
    {
        if (! $subtitle) {
            return $this;
        }

        $useHTML = $this->useHTML($subtitle);

        $this->subtitle = $subtitle;

        if ($useHTML) {
            $this->item['itunes:subtitle'] = [
                '_cdata' => $subtitle,
            ];
        } else {
            $this->item['itunes:subtitle'] = $subtitle;
        }

        return $this;
    }

    public function description(?string $description): self
    {
        if (! $description) {
            return $this;
        }

        $useHTML = $this->useHTML($description);

        $this->description = $description;

        if ($useHTML) {
            $this->item['description'] = [
                '_cdata' => $description,
            ];
            $this->item['content:encoded'] = [
                '_cdata' => $description,
            ];
        } else {
            $this->item['description'] = $description;
            $this->item['content:encoded'] = $description;
        }

        return $this;
    }

    public function publishDate(DateTime|string|null $publishDate): self
    {
        if (! $publishDate) {
            return $this;
        }

        if (is_string($publishDate)) {
            $publishDate = new DateTime($publishDate);
        }

        $this->publishDate = $publishDate;
        $this->item['pubDate'] = $publishDate->format(DateTime::RSS);

        return $this;
    }

    public function enclosure(?string $url, ?int $length, ?string $type): self
    {
        $enclosure = PodcastEnclosure::make()
            ->setUrl($url)
            ->setLength($length)
            ->setType($type);

        $this->enclosure = $enclosure;
        $this->item['enclosure'] = $enclosure->get();

        return $this;
    }

    public function link(?string $link): self
    {
        if (! $link) {
            return $this;
        }

        $this->link = $link;
        $this->item['link'] = $link;

        return $this;
    }

    public function author(?string $author): self
    {
        if (! $author) {
            return $this;
        }

        $this->author = $author;
        $this->item['dc:creator'] = [
            '_attributes' => [
                'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
            ],
            '_value' => $author,
        ];
        $this->item['author'] = $author;
        $this->item['itunes:author'] = $author;
        $this->item['googleplay:author'] = $author;

        return $this;
    }

    /**
     * @param  string[]|null  $keywords
     */
    public function keywords(?array $keywords): self
    {
        if (! $keywords) {
            return $this;
        }

        $this->keywords = $keywords;
        $this->item['itunes:keywords'] = implode(',', $keywords);

        return $this;
    }

    public function duration(?int $duration, bool $convert = false): self
    {
        if (! $duration) {
            return $this;
        }

        $this->duration = $duration;
        $this->item['itunes:duration'] = $convert ? $this->convertDuration($duration) : $duration;

        return $this;
    }

    /**
     * Episode type: `full`, `trailer`, `bonus`. Default: `full`.
     */
    public function episodeType(?ItunesEpisodeTypeEnum $episodeType): self
    {
        if (! $episodeType) {
            return $this;
        }

        $this->episodeType = $episodeType;
        $this->item['itunes:episodeType'] = $episodeType->value;

        return $this;
    }

    public function season(?int $season): self
    {
        if (! $season) {
            return $this;
        }

        $this->season = $season;
        $this->item['itunes:season'] = $this->season;

        return $this;
    }

    public function episode(?int $episode): self
    {
        if (! $episode) {
            return $this;
        }

        $this->episode = $episode;
        $this->item['itunes:episode'] = $this->episode;

        return $this;
    }

    public function isExplicit(): self
    {
        $this->isExplicit = true;
        $this->item['itunes:explicit'] = 'yes';

        return $this;
    }

    public function image(?string $image): self
    {
        if (! $image) {
            return $this;
        }

        $this->image = $image;
        $this->item['itunes:image'] = [
            '_attributes' => [
                'href' => $image,
            ],
        ];
        $this->item['googleplay:image'] = [
            '_attributes' => [
                'href' => $image,
            ],
        ];

        return $this;
    }

    public function chapters(): self
    {
        $this->item['psc:chapters'] = [
            '_attributes' => [
                'version' => '1.1',
            ],
            '_value' => '',
        ];

        return $this;
    }

    private function convertDuration(): string
    {
        $duration = $this->duration;
        $hours = floor($duration / 3600);
        $minutes = floor(($duration - $hours * 3600) / 60);
        $seconds = $duration - $hours * 3600 - $minutes * 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    private function useHTML(string $string): bool
    {
        $useHTML = false;
        if ($string !== strip_tags($string)) {
            $useHTML = true;
        }

        return $useHTML;
    }

    /**
     * @param  string[]  $fields
     */
    private function required(array $fields): void
    {
        foreach ($fields as $field) {
            if (! $this->{$field}) {
                throw new Exception("Podcast item `$field` is required");
            }
        }

    }

    public function get(): array
    {
        $this->title($this->title);
        $this->subtitle($this->subtitle);
        $this->description($this->description);
        $this->publishDate($this->publishDate);
        if ($this->enclosure) {
            $this->enclosure($this->enclosure->url(), $this->enclosure->length(), $this->enclosure->type());
        }
        $this->link($this->link);
        $this->author($this->author);
        $this->keywords($this->keywords);
        $this->duration($this->duration);
        $this->episodeType($this->episodeType);
        $this->season($this->season);
        $this->episode($this->episode);
        if ($this->isExplicit) {
            $this->isExplicit();
        }
        $this->image($this->image);

        // $this->required(['title', 'link', 'enclosure', 'publishDate']);

        // if (! $this->guid) {
        //     $this->guid = base64_encode($this->title.$this->publishDate->format(DateTime::RSS));
        //     $this->item = [
        //         'guid' => [
        //             '_attributes' => [
        //                 'isPermaLink' => 'false',
        //             ],
        //             '_value' => $this->guid,
        //         ],
        //         ...$this->item,
        //     ];
        // }

        return [
            ...$this->item,

        ];
    }
}
