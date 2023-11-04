<?php

namespace Zuske\AuthClient\Service\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Zuske\AuthClient\VO\TokenVO;

interface AuthClientServiceInterface
{
    public function makeLogin(string $pathInfo, SessionInterface $session): string;
    public function makeAuthentication(string $code, string $host = null): TokenVO;
    public function getRedirectRefer(SessionInterface $session): string;
}