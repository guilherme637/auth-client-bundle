<?php

namespace Zuske\AuthClient\Service\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Zuske\AuthClient\Security\OAuthClient;

class ClientAuthService implements ClientAuthServiceInterface
{
    private Client $client;
    private OAuthClient $authClient;

    public function __construct(OAuthClient $authClient)
    {
        $this->client = new Client([
            RequestOptions::VERIFY => false,
            RequestOptions::TIMEOUT => 15
        ]);
        $this->authClient = $authClient;
    }

    /**
     * @throws GuzzleException
     */
    public function makePullToken(array $tokenRequestDto, string $host = null): ResponseInterface
    {
        $uri = !is_null($host) ? $host : $this->authClient->getHost();

        return $this->client->request(
            'POST',
            $uri . '/token',
            [
                RequestOptions::FORM_PARAMS => $tokenRequestDto
            ]
        );
    }
}