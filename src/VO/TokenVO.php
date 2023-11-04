<?php

namespace Zuske\AuthClient\VO;

readonly class TokenVO
{
    public function __construct(private string $token, private \stdClass $tokenDecript) {}

    public function getToken(): string
    {
        return $this->token;
    }

    public function getTokenDecript(): \stdClass
    {
        return $this->tokenDecript;
    }
}