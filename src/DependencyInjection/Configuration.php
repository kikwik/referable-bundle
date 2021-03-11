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

            ->end()
        ;

        return $treeBuilder;
    }

}