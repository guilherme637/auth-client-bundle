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
        $this->containerBuilder = new ContainerBuilder();
        $extension = new AuthClientExtension();
        $extension->load($this->getConfigs(), $this->containerBuilder);
        $this->containerBuilder->compile();
    }

    public function getConfigs(): array
    {
        $configs['auth_client'] = [
            'auth'=> [
                'resource_owner' => 'auth-client',
                'client_id' => '132118881219cx12e1ds1132',
                'client_secret' => '132asd1231Ada2118881219cx12e1ds1132',
                'redirect_uris' => 'https://auth-client.com.br',
                'response_type' => 'code',
                'grant_type' => 'authorization_code',
                'scope' => 'r w',
                'host_client' => [
                    'host' => 'http://auth-service.com.br',
                    'port' => 3031
                ],
            ]
        ];

        return $configs;
    }
}