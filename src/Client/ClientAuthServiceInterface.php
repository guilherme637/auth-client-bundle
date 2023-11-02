<?php

namespace App\Infrastructure\Client;

use Psr\Http\Message\ResponseInterface;

interface ClientAuthServiceInterface
{
    public function makePullToken(array $tokenRequestDto): ResponseInterface;
}