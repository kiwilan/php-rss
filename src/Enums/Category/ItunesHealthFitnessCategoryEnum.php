<?php

namespace Kiwilan\Rss\Enums\Category;

use Kiwilan\Rss\Enums\ItunesEnumTrait;

enum ItunesHealthFitnessCategoryEnum: string
{
    use ItunesEnumTrait;

    case health_fitness_alternative_health = 'Alternative Health';
    case health_fitness_fitness = 'Fitness';
    case health_fitness_medicine = 'Medicine';
    case health_fitness_mental_health = 'Mental Health';
    case health_fitness_nutrition = 'Nutrition';
    case health_fitness_sexuality = 'Sexuality';
}
