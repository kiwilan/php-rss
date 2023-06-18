<?php

namespace Kiwilan\Rss\Enums;

/**
 * `itunes:explicit`
 *
 * Content advisory tag, “clean” for appropriate for children, “yes” for heavy profanity or adult-only
 * topics. Omit this tag for PG-level content. This is only necessary if different from the show-level tag.
 * Remember that a single explicit episode will remove your podcast from Apple Podcasts in 17 countries.
 */
enum ItunesExplicit: string
{
    case yes = 'yes';
    case no = 'no';
    case clean = 'clean';
}
