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


/**
 * @Hook("getSystemMessages")
 */
class GetSystemMessagesListener
{
    /**
     * @var array
     */
    protected $bundleConfig;

    /**
     * GetSystemMessagesListener constructor.
     */
    public function __construct(array $bundleConfig)
    {
        $this->bundleConfig = $bundleConfig;
    }

    public function __invoke(): string
    {
        if (isset($this->bundleConfig['pdf_indexer']['enabled']) && true === $this->bundleConfig['pdf_indexer']['enabled'] && !class_exists("Smalot\PdfParser\Parser"))  {
            return '<p class="tl_error">Smalot\PdfParser\Parser is needed for indexing pdf files. See <a href="https://github.com/heimrichhannot/contao-search-bundle" style="text-decoration: underline;" target="_blank">Search Bundle Readme</a> for more information. </p>';
        }
        return '';
    }
}