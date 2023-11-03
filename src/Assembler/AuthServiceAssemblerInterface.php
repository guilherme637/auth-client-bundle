<?php

namespace Zuske\AuthClient\Assembler;

use Zuske\AuthClient\Dto\TokenRequestDto;
use Zuske\AuthClient\Security\AuthClientResolver;

interface AuthServiceAssemblerInterface
{
    public function assemblerTokenPost(AuthClientResolver $authServiceResolver, string $code): TokenRequestDto;
    public function assemblerLogin(AuthClientResolver $authServiceResolver, string $state): string;
}