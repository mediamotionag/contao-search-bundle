<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\SearchBundle\EventListener;


use HeimrichHannot\SearchBundle\Command\RebuildSearchIndexCommand;
use HeimrichHannot\UtilsBundle\Url\UrlUtil;

class IndexPageListener
{
    /**
     * @var UrlUtil
     */
    private $urlUtil;
    /**
     * @var array
     */
    private $bundleConfig;

    public function __construct(array $bundleConfig, UrlUtil $urlUtil)
    {
        $this->urlUtil = $urlUtil;
        $this->bundleConfig = $bundleConfig;
    }


    /**
     * @Hook("indexPage")
     */
    public function onIndexPage(string $content, array $pageData, array &$indexData): void
    {
        if (isset($this->bundleConfig['disable_search_indexer']) && true === $this->bundleConfig['disable_search_indexer']) {
            $url = $indexData['url'];
            $url = $this->urlUtil->removeQueryString([RebuildSearchIndexCommand::CRAWL_PAGE_PARAMETER], $url, ['absoluteUrl' => true]);
            $indexData['url'] = $url;
        }
        return;
    }
}