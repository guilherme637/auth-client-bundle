<?php

namespace Zuske\AuthClient\Assembler;

use Zuske\AuthClient\Dto\TokenRequestDto;
use Zuske\AuthClient\Security\OAuthClient;

interface AuthServiceAssemblerInterface
{
    public function assemblerTokenPost(OAuthClient $authServiceResolver, string $code): TokenRequestDto;
    public function assemblerLogin(OAuthClient $authServiceResolver, string $state): string;
}