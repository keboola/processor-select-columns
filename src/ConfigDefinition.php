<?php

namespace Keboola\Processor\SelectColumns;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ConfigDefinition implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root("parameters");

        $rootNode
            ->children()
                ->arrayNode("columns")
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->scalarPrototype()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
