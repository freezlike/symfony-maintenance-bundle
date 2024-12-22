<?php


namespace FreezLike\MaintenanceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('maintenance');

        $treeBuilder->getRootNode()
            ->children()
            ->booleanNode('active')->defaultFalse()->end()
            ->scalarNode('next_maintenance_date')->defaultNull()->end()
            ->scalarNode('allowed_role')->defaultValue('ROLE_ADMIN')->end()
            ->end();

        return $treeBuilder;
    }
}
