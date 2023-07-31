<?php

namespace Kiwilan\Rss\Enums;

enum ItunesCategoryEnum: string
{
    use ItunesEnumToArrayTrait;
    use ItunesFromKey;

    case arts = 'Arts';

    case business = 'Business';

    case comedy = 'Comedy';

    case education = 'Education';

    case fiction = 'Fiction';

    case government = 'Government';

    case history = 'History';

    case health_fitness = 'Health & Fitness';

    case kids_and_family = 'Kids & Family';

    case leisure = 'Leisure';

    case music = 'Music';

    case news = 'News';

    case religion_spirituality = 'Religion & Spirituality';

    case science = 'Science';

    case society_culture = 'Society & Culture';

    case sports = 'Sports';

    case technology = 'Technology';

    case true_crime = 'True Crime';

    case tv_film = 'TV & Film';

    /**
     * @return ItunesSubCategoryEnum[]
     */
    public function subCategories(bool $toArray = true): array
    {
        return match ($this->name) {
            'arts' => ItunesSubCategoryEnum::arts($toArray),
            'business' => ItunesSubCategoryEnum::business($toArray),
            'comedy' => ItunesSubCategoryEnum::comedy($toArray),
            'education' => ItunesSubCategoryEnum::education($toArray),
            'fiction' => ItunesSubCategoryEnum::fiction($toArray),
            'government' => ItunesSubCategoryEnum::government($toArray),
            'history' => ItunesSubCategoryEnum::history($toArray),
            'health_fitness' => ItunesSubCategoryEnum::health_fitness($toArray),
            'kids_and_family' => ItunesSubCategoryEnum::kids_and_family($toArray),
            'leisure' => ItunesSubCategoryEnum::leisure($toArray),
            'music' => ItunesSubCategoryEnum::music($toArray),
            'news' => ItunesSubCategoryEnum::news($toArray),
            'religion_spirituality' => ItunesSubCategoryEnum::religion_spirituality($toArray),
            'science' => ItunesSubCategoryEnum::science($toArray),
            'society_culture' => ItunesSubCategoryEnum::society_culture($toArray),
            'sports' => ItunesSubCategoryEnum::sports($toArray),
            'technology' => ItunesSubCategoryEnum::technology($toArray),
            'true_crime' => ItunesSubCategoryEnum::true_crime($toArray),
            'tv_film' => ItunesSubCategoryEnum::tv_film($toArray),
            default => [],
        };
    }
}
