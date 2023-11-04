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
    private OAuthClient $OAuthClient;

    public function __construct(OAuthClient $OAuthClient)
    {
        $this->client = new Client([
            'base_uri' => $OAuthClient->getHost(),
            RequestOptions::VERIFY => false,
            RequestOptions::TIMEOUT => 15
        ]);
        $this->OAuthClient = $OAuthClient;
    }

    /**
     * @throws GuzzleException
     */
    public function makePullToken(array $tokenRequestDto): ResponseInterface
    {
        return $this->client->post(
            '/token',
            [
                RequestOptions::FORM_PARAMS => $tokenRequestDto
            ]
        );
    }
}