<?php

namespace Gpaton\ParseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('gpaton_parse');

        $rootNode
            ->children()
                ->scalarNode('app_id')
                    ->cannotBeEmpty()
                    ->info('You must provide your Parse.com Application ID')
                ->end()
                ->scalarNode('rest_key')
                    ->cannotBeEmpty()
                    ->info('You must provide your Parse.com REST API Key')
                ->end()
                ->scalarNode('master_key')
                    ->cannotBeEmpty()
                    ->info('You must provide your Parse.com Master Key')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
