<?php

namespace Zuske\AuthClient\Build;

use Zuske\AuthClient\Resolver\AuthServiceResolver;

class BuilderLogin
{
    private const QUERY = '/login?response_type=%s&client_id=%s&redirect_uri=%s&scope=%s&state=%s';

    public function build(AuthServiceResolver $loginRequest,string $state): string
    {
        return $loginRequest->getHost()
            . sprintf(
                self::QUERY,
                $loginRequest->getResponseType(),
                $loginRequest->getClientId(),
                $loginRequest->getRedirectUri(),
                $loginRequest->getScope(),
                $state
            );
    }
}