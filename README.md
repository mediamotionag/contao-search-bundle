# Contao Search Bundle

[![](https://img.shields.io/packagist/v/heimrichhannot/contao-search-bundle.svg)](https://packagist.org/packages/heimrichhannot/contao-search-bundle)
[![](https://img.shields.io/packagist/dt/heimrichhannot/contao-search-bundle.svg)](https://packagist.org/packages/heimrichhannot/contao-search-bundle)

This bundle contains enhancements for Contao Search.

## Features
* Rebuild search index command for contao versions before 4.9
* Disable search index update on page visit
* Page filter for search module
* Related search content element

## Usage

### Install

1. Install composer bundle: `composer require heimrichhannot/contao-search-bundle`
1. Optional: Install guzze HTTP client: `composer require guzzlehttp/guzzle` (needed for rebuild search index command)
1. Enable/Disable features you want in your project config (see chapter configuration) and clear your cache
1. Update your database

### Filter your search results by page

1. Enable `huh_search.enable_search_filter` in your config (enabled by default)
1. Create or edit your search engine module and setup the search filter section as you like

    ![Search engine module filter section](docs/images/screenshot_page_filter_module.png)

### Related search content element

This element is basically the content hyperlink element (also uses the same templates) but with the twist, that it keeps the search parameters. It's designed for use together with news filter to link to another search module with a different filter config.

1. Create a Related search link content element on a page with an search module
1. Set another page with a search module as target

### Disable search indexer

> If you use contao 4.9 or higher, we recommend to use the [core implementation](https://docs.contao.org/dev/framework/search-indexing/) instead.

This option let you disable indexing page on every page visit. This is recommend for large websites if you find performance issues or have a lot of duplicates in your search index.

1. Enable `huh_search.disable_search_indexer`
1. We recommend to use this option combined with the `huh:search:index` command

## Search index command

> If you use contao 4.9 or higher, we recommend to use the [core implementation](https://docs.contao.org/dev/framework/search-indexing/) instead.

This command let you build up your search index from console or a periodic cron job. This is especially useful, if you can't rebuild your search index from the contao backend.

```
Usage:
  huh:search:index [options]

Options:
      --dry-run                    Performs a run without purging the search database.
      --concurrency[=CONCURRENCY]  Number of parallel requests [default: 5]
```

## Configuration

```yaml
huh_search:

    # Enable or disable search filter for search module
    enable_search_filter: true

    # Configure whether you want to update the index entry on every request
    disable_search_indexer: false
```
