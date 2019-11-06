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


class LoadDataContainerListener
{
    /**
     * @var bool
     */
    protected $filterSearch = false;

    /**
     * LoadDataContainerListener constructor.
     * @param array $bundleConfig
     */
    public function __construct(array $bundleConfig)
    {
        if (isset($bundleConfig['enableSearchFilter']) && true === $bundleConfig['enableSearchFilter'])
        {
            $this->filterSearch = true;
        }

    }

    /**
     * @param string $table
     */
    public function onLoadDataContainer(string $table)
    {
        if ('tl_module' === $table && $this->filterSearch)
        {
            $dca = &$GLOBALS['TL_DCA']['tl_module'];

            $dca['palettes']['search'] = str_replace('rootPage', 'rootPage,pageMode,filterPages,addPageDepth', $dca['palettes']['search']);

            $fields        = [
                'pageMode'     => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_module']['pageMode'],
                    'exclude'   => true,
                    'inputType' => 'radio',
                    'options'   => ['exclude', 'include'],
                    'default'   => 'exclude',
                    'reference' => &$GLOBALS['TL_LANG']['tl_module'],
                    'eval'      => ['tl_class' => 'w50'],
                    'sql'       => "varchar(32) NOT NULL default 'exclude'",
                ],
                'filterPages'  => $dca['fields']['pages'],
                'addPageDepth' => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_module']['addPageDepth'],
                    'exclude'   => true,
                    'inputType' => 'checkbox',
                    'default'   => true,
                    'eval'      => ['tl_class' => 'w50 clr'],
                    'sql'       => "char(1) NOT NULL default '1'",
                ]
            ];
            $dca['fields'] = array_merge($fields, is_array($dca['fields']) ? $dca['fields'] : []);
        }
    }
}