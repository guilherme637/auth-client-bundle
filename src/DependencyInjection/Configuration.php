<?php

namespace Zuske\AuthClient\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('auth_client');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('auth')
                    ->children()
                        ->scalarNode('resource_owner')
                            ->isRequired()
                            ->defaultNull()
                        ->end()
                        ->scalarNode('client_id')
                            ->isRequired()
                            ->defaultNull()
                        ->end()
                        ->scalarNode('client_secret')
                            ->isRequired()
                            ->defaultNull()
                        ->end()
                        ->scalarNode('host_client')
                            ->isRequired()
                            ->defaultNull()
                        ->end()
                        ->scalarNode('redirect_uris')
                            ->isRequired()
                            ->defaultNull()
                            ->end()
                        ->scalarNode('response_type')
                            ->isRequired()
                            ->defaultNull()
                        ->end()
                        ->scalarNode('grant_type')
                            ->isRequired()
                            ->defaultNull()
                        ->end()
                        ->scalarNode('scope')
                            ->isRequired()
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}