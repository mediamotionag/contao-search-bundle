<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['customizeSearch']['contao-search-bundle'] = [\HeimrichHannot\SearchBundle\EventListener\CustomizeSearchListener::class, 'onCustomizeSearch'];
$GLOBALS['TL_HOOKS']['generatePage']['contao-search-bundle'] = [\HeimrichHannot\SearchBundle\EventListener\GeneratePageListener::class, 'onGeneratePage'];
$GLOBALS['TL_HOOKS']['indexPage']['contao-search-bundle'] = [\HeimrichHannot\SearchBundle\EventListener\IndexPageListener::class, 'onIndexPage'];
$GLOBALS['TL_HOOKS']['loadDataContainer']['contao-search-bundle'] = [\HeimrichHannot\SearchBundle\EventListener\LoadDataContainerListener::class, 'onLoadDataContainer'];

/**
 * Content Elements
 */
$GLOBALS['TL_CTE']['links'][\HeimrichHannot\SearchBundle\ContentElement\RelatedSearchLinkElement::TYPE] = \HeimrichHannot\SearchBundle\ContentElement\RelatedSearchLinkElement::class;