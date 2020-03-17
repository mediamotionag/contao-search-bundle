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
use Symfony\Component\Translation\TranslatorInterface;

class CustomizeSearchListener
{
    /**
     * @var bool
     */
    protected $enableFilterSearch = false;
    /**
     * @var TranslatorInterface
     */
    private $translator;
    /**
     * @var bool
     */
    private $disableMaxKeywordFilter = false;

    /**
     * CustomizeSearchListener constructor.
     * @param array $bundleConfig
     */
    public function __construct(array $bundleConfig, TranslatorInterface $translator)
    {
        if (isset($bundleConfig['enable_search_filter']) && true === $bundleConfig['enable_search_filter'])
        {
            $this->enableFilterSearch = true;
        }
        if (isset($bundleConfig['disable_max_keyword_filter']) && true === $bundleConfig['disable_max_keyword_filter'])
        {
            $this->disableMaxKeywordFilter = true;
        }

        $this->translator = $translator;
    }

    /**
     * @param array $pageIds
     * @param string $keywords
     * @param string $queryType
     * @param bool $fuzzy
     * @param ModuleSearch|Module $module
     */
    public function onCustomizeSearch(array &$pageIds, string &$keywords, string $queryType, bool $fuzzy, Module $module): void
    {
        if ($this->enableFilterSearch) {
            $this->filterSearch($pageIds, $module);
        }
        if (!$this->disableMaxKeywordFilter) {
            $this->filterInput($keywords, $module);
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

    protected function filterInput(string &$keywords, Module $module)
    {
        if ($module->maxKeywordCount < 1 ) {
            return;
        }
        $words = str_word_count($keywords, 2);
        if (is_array($words) && count($words) > $module->maxKeywordCount) {
            $indexes = array_keys($words);
            $keywords = substr($keywords, 0, ($indexes[$module->maxKeywordCount] - 1));
            $module->Template->maxKeywordsExceededMessage = $this->translator->trans('huh_search.module.max_keywords_exceeded_message', [
                "%max%" => $module->maxKeywordCount,
                "%count%" => count($words),
            ]);
        }
    }
}