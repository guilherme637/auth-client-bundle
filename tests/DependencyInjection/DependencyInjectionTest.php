<?php

namespace Zuske\AuthClient\Tests\DependencyInjection;

use Zuske\AuthClient\Security\OAuthClient;
use Zuske\AuthClient\Service\Auth\AuthClientService;
use Zuske\AuthClient\Service\Client\ClientAuthService;
use Zuske\AuthClient\Tests\Ultils\AbstractSetUp;

class DependencyInjectionTest extends AbstractSetUp
{
    public function testGetContainerOAuthClient()
    {
        /** @var OAuthClient $authClient */
        $authClient = $this->containerBuilder->get(OAuthClient::class);

        $this->assertInstanceOf(OAuthClient::class, $authClient);
    }

    public function testGetContainerAuthService()
    {
        /** @var AuthClientService $authClient */
        $authClient = $this->containerBuilder->get(AuthClientService::class);

        $this->assertInstanceOf(AuthClientService::class, $authClient);
    }

    public function testGetContainerClientAuthService()
    {
        /** @var ClientAuthService $authClient */
        $authClient = $this->containerBuilder->get(ClientAuthService::class);

        $this->assertInstanceOf(ClientAuthService::class, $authClient);
    }
}