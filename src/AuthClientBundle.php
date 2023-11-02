<?php

namespace Zuske\AuthClient;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AuthClientBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}