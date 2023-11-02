<?php

namespace Zuske\AuthClient\Assembler;

use Zuske\AuthClient\Build\BuilderLogin;
use Zuske\AuthClient\Dto\TokenRequestDto;
use Zuske\AuthClient\Resolver\AuthServiceResolver;

class AuthServiceAssembler implements AuthServiceAssemblerInterface
{
    public function assemblerTokenPost(AuthServiceResolver $authServiceResolver, string $code): TokenRequestDto
    {
        return new TokenRequestDto(
            $authServiceResolver->getGranType(),
            $authServiceResolver->getClientId(),
            $code,
            $authServiceResolver->getClientSecret(),
            $authServiceResolver->getRedirectUri()
        );
    }

    public function assemblerLogin(AuthServiceResolver $authServiceResolver, string $state): string
    {
        return (new BuilderLogin())->build($authServiceResolver, $state);
    }
}