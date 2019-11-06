<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_HOOKS']['customizeSearch']['contao-search-bundle'] = [\HeimrichHannot\SearchBundle\EventListener\CustomizeSearchListener::class, 'onCustomizeSearch'];
$GLOBALS['TL_HOOKS']['loadDataContainer']['contao-search-bundle'] = [\HeimrichHannot\SearchBundle\EventListener\LoadDataContainerListener::class, 'loadDataContainer'];