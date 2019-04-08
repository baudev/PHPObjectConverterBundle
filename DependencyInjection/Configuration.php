<?php

namespace Baudev\PHPObjectConverterBundle\DependencyInjection;


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
        $treeBuilder = new TreeBuilder('php_object_converter');

        $treeBuilder->getRootNode()
            ->children()
                ->booleanNode('ignore_annotations')->defaultFalse()->end()
                ->booleanNode('enable_annotations')->defaultFalse()->end()
                ->arrayNode('attributes')
                    ->children()
                        ->booleanNode('add_private')->defaultTrue()->end()
                        ->booleanNode('add_protected')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}