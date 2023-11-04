<?php

namespace Zuske\AuthClient\Service\Auth;

interface AuthClientServiceInterface
{
    public function makeLogin(string $pathInfo): string;
    public function makeAuthentication(string $code): \stdClass;
    public function getRedirectRefer(): string;
}