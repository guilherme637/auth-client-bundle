<?php

namespace Zuske\AuthClient\Service;

interface AuthClientServiceInterface
{
    public function makeLogin(string $pathInfo): string;
    public function makeAuthentication(string $code): string;
    public function getRedirectRefer(): string;
}