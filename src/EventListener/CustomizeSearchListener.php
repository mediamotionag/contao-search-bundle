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


use Contao\Module;
use Contao\ModuleSearch;

class CustomizeSearchListener
{
    /**
     * @param array $pageIds
     * @param string $keywords
     * @param string $queryType
     * @param bool $fuzzy
     * @param ModuleSearch|Module $module
     */
    public function onCustomizeSearch(array &$pageIds, string $keywords, string $queryType, bool $fuzzy, Module $module): void
    {

    }
}