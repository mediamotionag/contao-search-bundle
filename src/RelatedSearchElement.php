<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\SearchBundle;


use Contao\ContentHyperlink;
use Contao\Input;
use Contao\System;

class RelatedSearchElement extends ContentHyperlink
{
    const TYPE = 'related_search_link';

    protected function compile()
    {
        parent::compile();
        $query = '';
        $parameter = Input::get('keywords', false, true);
        if (!empty($parameter)) {
            $query .= 'keywords='.$parameter;
        }
        $parameter = Input::get('query_type', false, true);
        if (!empty($parameter)) {
            $query .= '&query_type='.$parameter;
        }
        $this->Template->href = System::getContainer()->get('huh.utils.url')->addQueryString($query, $this->url);
    }
}