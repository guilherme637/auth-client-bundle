<?php

namespace Zuske\AuthClient\Resolver;

readonly class AuthServiceResolver implements AuthServiceResolverInterface
{
    public function __construct(
        private ?string $resourceOwner,
        private ?string $host,
        private ?string $responseType,
        private ?string $grantType,
        private ?string $clientId,
        private ?string $clientSecret,
        private ?string $redirectUri,
        private ?string $scope,
    ) {
    }

    public function getResourceOwner(): ?string
    {
        return  $this->resourceOwner;
    }

    public function getHost(): ?string
    {
        return 'http://www' . $this->host;
    }

    public function getResponseType(): ?string
    {
        return $this->responseType;
    }

    public function getGranType(): ?string
    {
        return $this->grantType;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    public function getRedirectUri(): ?string
    {
        return $this->redirectUri;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }
}