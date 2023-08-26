# Changelog

All notable changes to `php-rss` will be documented in this file.

## v0.3.0 - 2023-08-26

- For `PodcastChannel`   
  - Add `<itunes:summary` for `description()`   
  - If `<itunes:subtitle>` is empty, strip tags from `description()` is used   
  - Remove `explicit()` method, use `isExplicit()` or `isNotExplicit()` instead (if you don't set it, it will be `false` by default)   
  
- For `PodcastItem`≈   
  - Add explicit and block options   
  - Allow `episodeType()` to be a `string`   
  
- Many bugfixes

## 0.2.2 - 2023-08-23

- Many fixes and improvements
- Split `author()` into `author()`, `ownerName()`, `ownerEmail()`
- Add `language()` parameter with `ItunesLanguageEnum` enum
- Add `atomLink()`

## 0.2.1 - 2023-06-28

- Remove `PodcastItem::class` required field
- Add `PodcastChannel::class` `guid` field
- Fix `categories` field

## 0.2.0 - 2023-06-20

- add `raw` option for channel

## 0.1.0 - 2023-06-18

init
