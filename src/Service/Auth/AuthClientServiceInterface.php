<?php

namespace Zuske\AuthClient\Service\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface AuthClientServiceInterface
{
    public function makeLogin(string $pathInfo, SessionInterface $session): string;
    public function makeAuthentication(string $code): \stdClass;
    public function getRedirectRefer(SessionInterface $session): string;
}