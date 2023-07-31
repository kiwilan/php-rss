<?php

use Kiwilan\Rss\Enums\ItunesCategoryEnum;
use Kiwilan\Rss\Enums\ItunesLanguageEnum;

it('can use categories', function () {
    $arts = ItunesCategoryEnum::arts;
    $business = ItunesCategoryEnum::business;
    $comedy = ItunesCategoryEnum::comedy;
    $education = ItunesCategoryEnum::education;
    $fiction = ItunesCategoryEnum::fiction;
    $government = ItunesCategoryEnum::government;
    $history = ItunesCategoryEnum::history;
    $health_fitness = ItunesCategoryEnum::health_fitness;
    $kids_and_family = ItunesCategoryEnum::kids_and_family;
    $leisure = ItunesCategoryEnum::leisure;
    $music = ItunesCategoryEnum::music;
    $news = ItunesCategoryEnum::news;
    $religion_spirituality = ItunesCategoryEnum::religion_spirituality;
    $science = ItunesCategoryEnum::science;
    $society_culture = ItunesCategoryEnum::society_culture;
    $sports = ItunesCategoryEnum::sports;
    $technology = ItunesCategoryEnum::technology;
    $true_crime = ItunesCategoryEnum::true_crime;
    $tv_film = ItunesCategoryEnum::tv_film;

    expect($arts->subCategories())->toBeArray();
    expect($business->subCategories())->toBeArray();
    expect($comedy->subCategories())->toBeArray();
    expect($education->subCategories())->toBeArray();
    expect($fiction->subCategories())->toBeArray();
    expect($government->subCategories())->toBeArray();
    expect($history->subCategories())->toBeArray();
    expect($health_fitness->subCategories())->toBeArray();
    expect($kids_and_family->subCategories())->toBeArray();
    expect($leisure->subCategories())->toBeArray();
    expect($music->subCategories())->toBeArray();
    expect($news->subCategories())->toBeArray();
    expect($religion_spirituality->subCategories())->toBeArray();
    expect($science->subCategories())->toBeArray();
    expect($society_culture->subCategories())->toBeArray();
    expect($sports->subCategories())->toBeArray();
    expect($technology->subCategories())->toBeArray();
    expect($true_crime->subCategories())->toBeArray();
    expect($tv_film->subCategories())->toBeArray();
});

it('can use languages', function () {
    $englishUnitedStates = ItunesLanguageEnum::englishUnitedStates;

    expect($englishUnitedStates->code())->toBe('en-US');
    expect($englishUnitedStates->country())->toBe('English (United States)');
});
