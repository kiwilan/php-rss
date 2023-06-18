<?php

namespace Kiwilan\Rss\Enums;

// @docs: https://podcasters.apple.com/support/1691-apple-podcasts-categories
enum ItunesCategoryEnum: string
{
    case arts = 'Arts';
    case business = 'Business';
    case comedy = 'Comedy';
    case education = 'Education';
    case fiction = 'Fiction';
    case government = 'Government';
    case history = 'History';
    case health_fitness = 'Health &amp; Fitness';
    case kids_and_family = 'Kids &amp; Family';
    case leisure = 'Leisure';
    case music = 'Music';
    case news = 'News';
    case religion_spirituality = 'Religion &amp; Spirituality';
    case science = 'Science';
    case society_culture = 'Society &amp; Culture';
    case sports = 'Sports';
    case technology = 'Technology';
    case true_crime = 'True Crime';
    case tv_film = 'TV &amp; Film';
}
