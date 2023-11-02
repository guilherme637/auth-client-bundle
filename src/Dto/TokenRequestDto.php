<?php

namespace Zuske\AuthClient\Dto;

class TokenRequestDto
{
    public function __construct(
        private string $grantType,
        private string $clientId,
        private string $code,
        private string $clientSecret,
        private string $redirectId,
    ) {}

    public function getGrantType(): string
    {
        return $this->grantType;
    }

    public function setGrantType(string $grantType): void
    {
        $this->grantType = $grantType;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    public function getRedirectId(): string
    {
        return $this->redirectId;
    }

    public function setRedirectId(string $redirectId): void
    {
        $this->redirectId = $redirectId;
    }
}