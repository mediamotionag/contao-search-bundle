<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\SearchBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('huh_search');

        $rootNode
            ->children()
                ->booleanNode('enable_search_filter')->defaultTrue()->info("Enable or disable search filter for search module")->end()
                ->booleanNode('disable_max_keyword_filter')->defaultFalse()->info("Enable or disable max keyword filter for search module")->end()
                ->booleanNode('disable_search_indexer')->defaultFalse()->info("Configure whether you want to update the index entry on every request")->end()
                ->scalarNode('valid_word_chars')->defaultValue('ÄäÖöÜüẞß')->info("Set additional chars that should be not break a word (used for charlist parameter of str_word_count function).")->end()
            ->end()
        ;

        return $treeBuilder;
    }


}