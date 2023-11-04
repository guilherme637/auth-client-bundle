<?php

namespace Zuske\AuthClient\Build;

use Zuske\AuthClient\Security\OAuthClient;

class BuilderUrlLogin
{
    private const QUERY = '/login?response_type=%s&client_id=%s&redirect_uri=%s&scope=%s&state=%s';

    public function build(OAuthClient $authClient, string $state): string
    {
        return $authClient->getHost()
            . sprintf(
                self::QUERY,
                $authClient->getResponseType(),
                $authClient->getClientId(),
                $authClient->getRedirectUri(),
                $authClient->getScope(),
                $state
            );
    }
}