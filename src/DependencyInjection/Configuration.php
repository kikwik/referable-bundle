<?php

namespace Kikwik\ReferableBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('kikwik_referable');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('interfaces')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('cookie_name')->end()
                            ->arrayNode('query_params')->requiresAtLeastOneElement()->scalarPrototype()->end()->end()
                            ->scalarNode('expire')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}