<?php

namespace Zuske\AuthClient\Tests\Build;

use Zuske\AuthClient\Build\BuilderUrlLogin;
use Zuske\AuthClient\Security\OAuthClient;
use Zuske\AuthClient\Tests\Ultils\AbstractSetUp;

class Build extends AbstractSetUp
{
    private const URL = 'http://www.http://auth-service.com.br:3031/login?response_type=code&client_id=132118881219cx12e1ds1132&redirect_uri=https://auth-client.com.br&scope=r w&state=$state';
    public function testBuildUrlLogin()
    {
        /** @var OAuthClient $authClient */
        $authClient =$this->containerBuilder->get(OAuthClient::class);
        $this->assertEquals(
            self::URL,
            (new BuilderUrlLogin())->build($authClient, '$state')
        );
    }
}