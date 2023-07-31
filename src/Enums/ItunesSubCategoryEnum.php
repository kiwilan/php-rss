<?php

namespace Kiwilan\Rss\Enums;

enum ItunesSubCategoryEnum: string
{
    use ItunesEnumToArrayTrait;
    use ItunesFromKey;

    // Arts
    case arts_books = 'Books';

    case arts_design = 'Design';

    case arts_fashion_and_beauty = 'Fashion & Beauty';

    case arts_food = 'Food';

    case arts_performing_arts = 'Performing Arts';

    case arts_visual_arts = 'Visual Arts';

    // Business
    case business_careers = 'Careers';

    case business_entrepreneurship = 'Entrepreneurship';

    case business_investing = 'Investing';

    case business_management = 'Management';

    case business_marketing = 'Marketing';

    case business_non_profit = 'Non-Profit';

    // Comedy
    case comedy_comedy_interviews = 'Comedy Interviews';

    case comedy_improv = 'Improv';

    case comedy_stand_up = 'Stand-Up';

    // Education
    case education_courses = 'Courses';

    case education_how_to = 'How To';

    case education_language_learning = 'Language Learning';

    case education_self_improvement = 'Self-Improvement';

    // Fiction
    case fiction_comedy_fiction = 'Comedy Fiction';

    case fiction_drama = 'Drama';

    case fiction_science_fiction = 'Science Fiction';

    // Health & Fitness
    case health_fitness_alternative_health = 'Alternative Health';

    case health_fitness_fitness = 'Fitness';

    case health_fitness_medicine = 'Medicine';

    case health_fitness_mental_health = 'Mental Health';

    case health_fitness_nutrition = 'Nutrition';

    case health_fitness_sexuality = 'Sexuality';

    // Kids & Family
    case kids_family_education_for_kids = 'Education for Kids';

    case kids_family_parenting = 'Parenting';

    case kids_family_pets_and_animals = 'Pets & Animals';

    case kids_family_stories_for_kids = 'Stories for Kids';

    // Leisure
    case leisure_animation_and_manga = 'Animation & Manga';

    case leisure_automotive = 'Automotive';

    case leisure_aviation = 'Aviation';

    case leisure_crafts = 'Crafts';

    case leisure_games = 'Games';

    case leisure_hobbies = 'Hobbies';

    case leisure_home_and_garden = 'Home & Garden';

    case leisure_video_games = 'Video Games';

    // Music
    case music_commentary = 'Music Commentary';

    case music_history = 'Music History';

    case music_interviews = 'Music Interviews';

    // News
    case news_business = 'Business News';

    case news_daily = 'Daily News';

    case news_entertainmen = 'Entertainment News';

    case news_commentary = 'News Commentary';

    case news_politics = 'Politics';

    case news_sports = 'Sports News';

    case news_tech = 'Tech News';

    // Religion & Spirituality
    case religion_spirituality_buddhism = 'Buddhism';

    case religion_spirituality_christianity = 'Christianity';

    case religion_spirituality_hinduism = 'Hinduism';

    case religion_spirituality_islam = 'Islam';

    case religion_spirituality_judaism = 'Judaism';

    case religion_spirituality_religion = 'Religion';

    case religion_spirituality_spirituality = 'Spirituality';

    // Science
    case science_astronomy = 'Astronomy';

    case science_chemistry = 'Chemistry';

    case science_earth_sciences = 'Earth Sciences';

    case science_life_sciences = 'Life Sciences';

    case science_mathematics = 'Mathematics';

    case science_natural_sciences = 'Natural Sciences';

    case science_nature = 'Nature';

    case science_physics = 'Physics';

    case science_social_sciences = 'Social Sciences';

    // Society & Culture
    case society_culture_documentary = 'Documentary';

    case society_culture_personal_journals = 'Personal Journals';

    case society_culture_philosophy = 'Philosophy';

    case society_culture_places_and_travel = 'Places & Travel';

    case society_culture_relationships = 'Relationships';

    // Sports
    case sports_baseball = 'Baseball';

    case sports_basketball = 'Basketball';

    case sports_cricket = 'Cricket';

    case sports_fantasy_sports = 'Fantasy Sports';

    case sports_football = 'Football';

    case sports_golf = 'Golf';

    case sports_hockey = 'Hockey';

    case sports_rugby = 'Rugby';

    case sports_soccer = 'Soccer';

    case sports_swimming = 'Swimming';

    case sports_tennis = 'Tennis';

    case sports_volleyball = 'Volleyball';

    case sports_wilderness = 'Wilderness';

    case sports_wrestling = 'Wrestling';

    // TV & Film
    case tv_film_after_shows = 'After Shows';

    case tv_film_film_history = 'Film History';

    case tv_film_film_interviews = 'Film Interviews';

    case tv_film_film_reviews = 'Film Reviews';

    case tv_film_tv_reviews = 'TV Reviews';

    public static function arts(bool $toArray = true): array
    {
        $items = [
            self::arts_books,
            self::arts_design,
            self::arts_fashion_and_beauty,
            self::arts_food,
            self::arts_performing_arts,
            self::arts_visual_arts,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function business(bool $toArray = true): array
    {
        $items = [
            self::business_careers,
            self::business_entrepreneurship,
            self::business_investing,
            self::business_management,
            self::business_marketing,
            self::business_non_profit,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function comedy(bool $toArray = true): array
    {
        $items = [
            self::comedy_comedy_interviews,
            self::comedy_improv,
            self::comedy_stand_up,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function education(bool $toArray = true): array
    {
        $items = [
            self::education_courses,
            self::education_how_to,
            self::education_language_learning,
            self::education_self_improvement,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function fiction(bool $toArray = true): array
    {
        $items = [
            self::fiction_comedy_fiction,
            self::fiction_drama,
            self::fiction_science_fiction,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function government(bool $toArray = true): array
    {
        $items = [];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function history(bool $toArray = true): array
    {
        $items = [];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function health_fitness(bool $toArray = true): array
    {
        $items = [
            self::health_fitness_alternative_health,
            self::health_fitness_fitness,
            self::health_fitness_medicine,
            self::health_fitness_mental_health,
            self::health_fitness_nutrition,
            self::health_fitness_sexuality,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function kids_and_family(bool $toArray = true): array
    {
        $items = [
            self::kids_family_education_for_kids,
            self::kids_family_parenting,
            self::kids_family_pets_and_animals,
            self::kids_family_stories_for_kids,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function leisure(bool $toArray = true): array
    {
        $items = [
            self::leisure_animation_and_manga,
            self::leisure_automotive,
            self::leisure_aviation,
            self::leisure_crafts,
            self::leisure_games,
            self::leisure_hobbies,
            self::leisure_home_and_garden,
            self::leisure_video_games,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function music(bool $toArray = true): array
    {
        $items = [
            self::music_commentary,
            self::music_history,
            self::music_interviews,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function news(bool $toArray = true): array
    {
        $items = [
            self::news_business,
            self::news_daily,
            self::news_entertainmen,
            self::news_commentary,
            self::news_politics,
            self::news_sports,
            self::news_tech,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function religion_spirituality(bool $toArray = true): array
    {
        $items = [
            self::religion_spirituality_buddhism,
            self::religion_spirituality_christianity,
            self::religion_spirituality_hinduism,
            self::religion_spirituality_islam,
            self::religion_spirituality_judaism,
            self::religion_spirituality_religion,
            self::religion_spirituality_spirituality,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function science(bool $toArray = true): array
    {
        $items = [
            self::science_astronomy,
            self::science_chemistry,
            self::science_earth_sciences,
            self::science_life_sciences,
            self::science_mathematics,
            self::science_natural_sciences,
            self::science_nature,
            self::science_physics,
            self::science_social_sciences,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function society_culture(bool $toArray = true): array
    {
        $items = [
            self::society_culture_documentary,
            self::society_culture_personal_journals,
            self::society_culture_philosophy,
            self::society_culture_places_and_travel,
            self::society_culture_relationships,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function sports(bool $toArray = true): array
    {
        $items = [
            self::sports_baseball,
            self::sports_basketball,
            self::sports_cricket,
            self::sports_fantasy_sports,
            self::sports_football,
            self::sports_golf,
            self::sports_hockey,
            self::sports_rugby,
            self::sports_soccer,
            self::sports_swimming,
            self::sports_tennis,
            self::sports_volleyball,
            self::sports_wilderness,
            self::sports_wrestling,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function technology(bool $toArray = true): array
    {
        $items = [];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function true_crime(bool $toArray = true): array
    {
        $items = [];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    public static function tv_film(bool $toArray = true): array
    {
        $items = [
            self::tv_film_after_shows,
            self::tv_film_film_history,
            self::tv_film_film_interviews,
            self::tv_film_film_reviews,
            self::tv_film_tv_reviews,
        ];

        return $toArray ? self::subCategoryToArray($items) : $items;
    }

    private static function subCategoryToArray(array $subCategories): array
    {
        $enums = [];

        /** @var ItunesSubCategoryEnum $subCategory */
        foreach ($subCategories as $subCategory) {
            $enums[$subCategory->name] = $subCategory->value;
        }

        return $enums;
    }
}
