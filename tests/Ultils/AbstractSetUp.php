<?php

namespace Zuske\AuthClient\Tests\Ultils;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Zuske\AuthClient\DependencyInjection\AuthClientExtension;

class AbstractSetUp extends TestCase
{
    protected ContainerBuilder $containerBuilder;

    protected function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $extension = new AuthClientExtension();
        $extension->load($this->getConfigs(), $this->container);
        $this->container->compile();
    }

    public function getConfigs(): array
    {
        $configs['auth_client'] = [
            'auth'=> [
                'resource_owner' => 'teste1',
                'client_id' => 'teste2',
                'client_secret' => 'teste3',
                'redirect_uris' => 'teste5',
                'response_type' => 'teste6',
                'grant_type' => 'teste8',
                'scope' => 'teste9',
                'host_client' => [
                    'host' => 'teste',
                    'port' => 3031
                ],
            ]
        ];

        return $configs;
    }
}