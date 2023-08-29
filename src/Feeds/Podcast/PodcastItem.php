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
        protected bool $autoGuid = false,
        protected ?string $subtitle = null, // `itunes:subtitle`
        protected ?string $description = null, // `description`, `content:encoded`
        protected ?string $summary = null, // `itunes:summary`
        protected ?DateTime $publishDate = null, // `pubDate`
        protected ?PodcastEnclosure $enclosure = null, // `enclosure`
        protected ?string $link = null, // `link`
        protected ?string $author = null, // `itunes:author`, `googleplay:author`
        protected ?array $keywords = null, // `itunes:keywords`
        protected ?int $duration = null, // `itunes:duration`
        protected ItunesEpisodeTypeEnum $episodeType = ItunesEpisodeTypeEnum::full, // `itunes:episodeType`
        protected string|int|null $season = null, // `itunes:season`, `podcast:season`
        protected string|int|null $episode = null, // `itunes:episode`, `podcast:episode`
        protected bool $isExplicit = false, // `itunes:explicit`, `googleplay:explicit`
        protected bool $block = false, // `itunes:block`, `googleplay:block`
        protected ?string $image = null, // `itunes:image`, `googleplay:image`
        protected array $chapters = [], // `psc:chapters`
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
     * Unique identifier for the episode.
     *
     * Can be auto-generated with `autoGuid()`.
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

    /**
     * Auto-generate a unique identifier for the episode from `title` and `publishDate`.
     *
     * WARNING:
     * - If you change `title` or `publishDate` after the guid will be updated (and it's a problem for podcast apps)
     * - If `guid` is set, it will be used instead
     */
    public function autoGuid(): self
    {
        $this->autoGuid = true;

        return $this;
    }

    /**
     * Subtitle, for `itunes:subtitle`.
     */
    public function subtitle(?string $subtitle): self
    {
        if (! $subtitle) {
            return $this;
        }

        $isHtml = $this->isHtml($subtitle);

        $this->subtitle = $subtitle;

        if ($isHtml) {
            $this->item['itunes:subtitle'] = [
                '_cdata' => $subtitle,
            ];
        } else {
            $this->item['itunes:subtitle'] = $subtitle;
        }

        return $this;
    }

    /**
     * Description, for `itunes:summary`, `googleplay:description`, `description`, `content:encoded`.
     */
    public function description(?string $description): self
    {
        if (! $description) {
            return $this;
        }

        $isHtml = $this->isHtml($description);

        $this->description = $description;

        if ($isHtml) {
            $this->item['googleplay:description'] = [
                '_cdata' => $description,
            ];
            $this->item['itunes:summary'] = [
                '_cdata' => $description,
            ];
            $this->item['description'] = [
                '_cdata' => $description,
            ];
            $this->item['content:encoded'] = [
                '_cdata' => $description,
            ];
        } else {
            $this->item['googleplay:description'] = $description;
            $this->item['itunes:summary'] = $description;
            $this->item['description'] = $description;
            $this->item['content:encoded'] = $description;
        }

        return $this;
    }

    /**
     * Publish date, for `pubDate`.
     */
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

    /**
     * Enclosure with direct URL of episode, length and type for `enclosure`.
     */
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

    /**
     * Link to the episode, for `link`.
     */
    public function link(?string $link): self
    {
        if (! $link) {
            return $this;
        }

        $this->link = $link;
        $this->item['link'] = $link;

        return $this;
    }

    /**
     * Author, for `dc:creator`, `author`, `itunes:author`, `googleplay:author`.
     */
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
     * Keywords, for `itunes:keywords`.
     *
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

    /**
     * Duration in seconds, for `itunes:duration`.
     */
    public function duration(int|float|null $duration, bool $convert = false): self
    {
        if (! $duration) {
            return $this;
        }

        $this->duration = intval($duration);
        $this->item['itunes:duration'] = $convert ? $this->convertDuration($duration) : $duration;

        return $this;
    }

    /**
     * Episode type: `full`, `trailer`, `bonus`. Default: `full`.
     */
    public function episodeType(ItunesEpisodeTypeEnum|string|null $episodeType): self
    {
        if (! $episodeType) {
            return $this;
        }

        if (is_string($episodeType)) {
            $episodeType = ItunesEpisodeTypeEnum::tryFrom($episodeType);
        }

        $this->episodeType = $episodeType;
        $this->item['itunes:episodeType'] = $episodeType->value;

        return $this;
    }

    /**
     * Season number, for `itunes:season`, `podcast:season`.
     */
    public function season(string|int|null $season): self
    {
        if (! $season) {
            return $this;
        }

        $this->season = $season;
        $this->item['itunes:season'] = $this->season;
        $this->item['podcast:season'] = $this->season;

        return $this;
    }

    /**
     * Episode number, for `itunes:episode`, `podcast:episode`.
     */
    public function episode(string|int|null $episode): self
    {
        if (! $episode) {
            return $this;
        }

        $this->episode = $episode;
        $this->item['itunes:episode'] = $this->episode;
        $this->item['podcast:episode'] = $this->episode;

        return $this;
    }

    /**
     * Explicit content, for `itunes:explicit`, `googleplay:explicit`.
     */
    public function isExplicit(): self
    {
        $this->isExplicit = true;
        $this->item['itunes:explicit'] = 'yes';
        $this->item['googleplay:explicit'] = 'yes';

        return $this;
    }

    private function isNotExplicit(): self
    {
        $this->isExplicit = true;
        $this->item['itunes:explicit'] = 'no';
        $this->item['googleplay:explicit'] = 'no';

        return $this;
    }

    /**
     * Podcast image, for `image`, `itunes:image`, `googleplay:image`.
     */
    public function image(?string $image): self
    {
        if (! $image) {
            return $this;
        }

        $this->image = $image;

        $this->item['image'] = [
            'url' => $image,
            'title' => $this->title,
            'link' => $this->link,
        ];
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

    /**
     * Add chapters to the episode, for `psc:chapters`.
     *
     * @param  string  $start  Start time in seconds, e.g. `00:06:00`.
     * @param  string  $title  Chapter title.
     */
    public function addChapter(string $start, string $title): self
    {
        $this->chapters[] = [
            'start' => $start,
            'title' => $title,
        ];

        return $this;
    }

    /**
     * Block the episode for crawlers, for `itunes:block`, `googleplay:block`.
     */
    public function isPrivate(): self
    {
        $this->block = true;
        $this->item['itunes:block'] = 'yes';
        $this->item['googleplay:block'] = 'yes';

        return $this;
    }

    private function isNotPrivate(): self
    {
        $this->block = false;
        $this->item['itunes:block'] = 'no';
        $this->item['googleplay:block'] = 'no';

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

    private function isHtml(string $string): bool
    {
        $isHtml = false;

        if ($string !== strip_tags($string)) {
            $isHtml = true;
        }

        return $isHtml;
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
        } else {
            $this->isNotExplicit();
        }
        $this->image($this->image);

        if ($this->block) {
            $this->isPrivate();
        } else {
            $this->isNotPrivate();
        }

        if (! empty($this->chapters)) {
            $this->item['psc:chapters'] = [
                '_attributes' => [
                    'version' => '1.1',
                ],
            ];

            foreach ($this->chapters as $chapter) {
                $this->item['psc:chapters']['psc:chapter'][] = [
                    '_attributes' => [
                        'start' => $chapter['start'],
                        'title' => $chapter['title'],
                    ],
                ];
            }
        }

        if (! $this->subtitle && $this->description) {
            $subtitle = $this->description;
            $subtitle = strip_tags($subtitle);
            $subtitle = substr($subtitle, 0, 252);
            $this->subtitle("{$subtitle}...");
        }

        if ($this->autoGuid && ! $this->guid) {
            $name = "{$this->title}-{$this->publishDate->format('Y-m-d')}";
            $guid = bin2hex($name);
            $this->guid($guid);
        }

        return [
            ...$this->item,
        ];
    }
}
