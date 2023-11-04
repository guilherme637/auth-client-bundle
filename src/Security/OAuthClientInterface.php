<?php

namespace Zuske\AuthClient\Security;

interface OAuthClientInterface
{
    public function getResourceOwner(): ?string;
    public function getHost(): ?string;
    public function getResponseType(): ?string;
    public function getGranType(): ?string;
    public function getClientId(): ?string;
    public function getClientSecret(): ?string;
    public function getRedirectUri(): ?string;
    public function getScope(): ?string;
}