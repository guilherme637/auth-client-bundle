<?php

namespace Zuske\AuthClient\Tests\DependencyInjection;

use Zuske\AuthClient\Security\OAuthClient;
use Zuske\AuthClient\Tests\Ultils\AbstractSetUp;

class DependencyInjectionTest extends AbstractSetUp
{
    public function testGetContainerOAuthClient()
    {
        $authClient = $this->container->get(OAuthClient::class);

        $this->assertInstanceOf(OAuthClient::class, $authClient);
    }
}