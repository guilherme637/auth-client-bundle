<?php

namespace Zuske\AuthClient\Service\Client;

use Psr\Http\Message\ResponseInterface;

interface ClientAuthServiceInterface
{
    public function makePullToken(array $tokenRequestDto, string $host = null): ResponseInterface;
}