<?php

namespace Zuske\AuthClient\Assembler;

use Zuske\AuthClient\Dto\TokenRequestDto;
use Zuske\AuthClient\Resolver\AuthServiceResolver;

interface AuthServiceAssemblerInterface
{
    public function assemblerTokenPost(AuthServiceResolver $authServiceResolver, string $code): TokenRequestDto;
    public function assemblerLogin(AuthServiceResolver $authServiceResolver, string $state): string;
}