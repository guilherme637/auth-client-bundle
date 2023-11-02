<?php

namespace Zuske\AuthClient;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Zuske\AuthClient\DependencyInjection\AuthClientExtension;

class AuthClientBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new AuthClientExtension();
    }
}