<?php

use Zuske\AuthClient\Security\OAuthClient;
use Zuske\AuthClient\Service\Auth\AuthClientService;

require_once __DIR__ . '/vendor/autoload.php';

$configs['zuske_auth_client']  = ['auth'=> [
    'resource_owner' => 'teste1',
    'client_id' => 'teste2',
    'client_secret' => 'teste3',
    'redirect_uris' => 'teste5',
    'response_type' => 'teste6',
    'grant_type' => 'teste8',
    'scope' => 'teste9',
    'host_client' => [
        'host' => 'teste',
        'port' => 3031
    ],
]];

try {
    // Build the service container

    /** @var OAuthClient $authClient */
    $authClient = $container->get(OAuthClient::class);
    $authClientService = $container->get(AuthClientService::class);
    print_r($authClientService);
    exit();

} catch (\Throwable $e) {
    print_r($e->getMessage());
    exit();
}
