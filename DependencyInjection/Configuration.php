<?php

namespace Wolnosciowiec\FileRepositoryBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Tells the framework that we need to register a group
     * of configuration, that is required for this bundle to work
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('file_repository');

        $rootNode
            ->children()
            ->scalarNode('url')
                ->isRequired()
                ->end()
            ->scalarNode('token')
                ->isRequired()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}