<?php

namespace Zuske\AuthClient\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Zuske\AuthClient\Security\OAuthClient;

class AuthClientExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $config = $this->processConfiguration(new Configuration(), $configs);
        $authClient = $container->getDefinition(OAuthClient::class);

        foreach ($config['auth'] as $value) {
            $this->buildNodeHostClient($value, $authClient);
            $authClient->addArgument($value);
        }
    }

    public function buildNodeHostClient(mixed $value, Definition $definition): void
    {
        if (is_array($value)) {
            $definition->addArgument($value);
        }
    }
}