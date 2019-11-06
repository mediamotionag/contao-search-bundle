<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\SearchBundle\EventListener;


use Contao\Database;
use Contao\Module;
use Contao\ModuleSearch;
use Contao\StringUtil;

class CustomizeSearchListener
{
    /**
     * @var bool
     */
    protected $enableFilterSearch = false;

    /**
     * CustomizeSearchListener constructor.
     * @param array $bundleConfig
     */
    public function __construct(array $bundleConfig)
    {
        if (isset($bundleConfig['enable_search_filter']) && true === $bundleConfig['enable_search_filter'])
        {
            $this->enableFilterSearch = true;
        }

    }

    /**
     * @param array $pageIds
     * @param string $keywords
     * @param string $queryType
     * @param bool $fuzzy
     * @param ModuleSearch|Module $module
     */
    public function onCustomizeSearch(array &$pageIds, string $keywords, string $queryType, bool $fuzzy, Module $module): void
    {
        if ($this->enableFilterSearch) {
            $this->filterSearch($pageIds, $module);
        }
    }

    protected function filterSearch(array &$pageIds, Module $module)
    {
        $filterPages = StringUtil::deserialize($module->filterPages, true);
        if (!empty($filterPages) && $module->pageMode)
        {
            if ($module->addPageDepth)
            {
                $filterPages = array_merge($filterPages, Database::getInstance()->getChildRecords($filterPages, 'tl_page'));
            }

            switch ($module->pageMode)
            {
                case 'include':
                    $pageIds = $filterPages;
                    break;
                case 'exclude':
                    $pageIds = array_diff($pageIds, $filterPages);
                    break;
            }
        }
    }
}