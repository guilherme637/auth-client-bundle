<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Zuske\AuthClient\DependencyInjection\AuthClientExtension;
use Zuske\AuthClient\Security\AuthClientResolver;

require_once __DIR__ . '/vendor/autoload.php';

$configs['zuske_auth_client']  = ['auth'=> [
    'resource_owner' => 'teste1',
    'client_id' => 'teste2',
    'client_secret' => 'teste3',
    'host_client' => 'teste4',
    'redirect_uris' => 'teste5',
    'response_type' => 'teste6',
    'grant_type' => 'teste8',
    'scope' => 'teste9',
]];

try {
    // Build the service container
    $container = new ContainerBuilder();
    $extension = new AuthClientExtension();
    $extension->load($configs, $container);
    $container->compile();
    /** @var AuthClientResolver $authService */
    $authService = $container->get(AuthClientResolver::class);
    dump($authService);
    exit();

} catch (\Throwable $e) {
    var_dump($e);
    exit();
}
