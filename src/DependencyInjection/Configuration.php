<?php

namespace Zuske\AuthClient\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('zuske_auth_client');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('auth')
                    ->children()
                        ->scalarNode('resource_owner')->end()
                            ->isRequired()
                            ->defaultNull()
                        ->scalarNode('client_id')->end()
                            ->isRequired()
                            ->defaultNull()
                        ->scalarNode('client_secret')->end()
                            ->isRequired()
                            ->defaultNull()
                        ->scalarNode('host_client')->end()
                            ->isRequired()
                            ->defaultNull()
                        ->scalarNode('redirect_uris')->end()
                            ->isRequired()
                            ->defaultNull()
                        ->scalarNode('response_type')->end()
                            ->isRequired()
                            ->defaultNull()
                        ->scalarNode('grant_type')->end()
                            ->isRequired()
                            ->defaultNull()
                        ->scalarNode('scope')->end()
                            ->isRequired()
                            ->defaultNull()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}