<?php

namespace Zuske\AuthClient\Security;

readonly class OAuthClient implements OAuthClientInterface
{
    public function __construct(
        private ?string $resourceOwner,
        private ?string $responseType,
        private ?string $grantType,
        private ?string $clientId,
        private ?string $clientSecret,
        private ?string $redirectUri,
        private ?string $scope,
        private ?array $host,
    ) {
    }

    public function getResourceOwner(): ?string
    {
        return  $this->resourceOwner;
    }

    public function getHost(): ?string
    {
        $port = $this->host['port'] ? ':' . $this->host['port'] : '';

        return 'http://www.' . $this->host['host'] . $port;
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