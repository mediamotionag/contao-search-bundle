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


use Contao\Input;
use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;
use HeimrichHannot\SearchBundle\Command\RebuildSearchIndexCommand;

class GeneratePageListener
{
    /**
     * @var array
     */
    private $bundleConfig;

    public function __construct(array $bundleConfig)
    {
        $this->bundleConfig = $bundleConfig;
    }


    /**
     * @Hook("initializeSystem")
     */
    public function onGeneratePage(PageModel $pageModel, LayoutModel $layout, PageRegular $pageRegular): void
    {
        if (isset($this->bundleConfig['disable_search_indexer']) && true === $this->bundleConfig['disable_search_indexer']) {
            if (Input::get(RebuildSearchIndexCommand::CRAWL_PAGE_PARAMETER) !== '1') {
                $pageModel->noSearch = '1;';
            }
        }
    }
}