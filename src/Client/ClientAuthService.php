<?php

namespace App\Infrastructure\Client;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class ClientAuthService implements ClientAuthServiceInterface
{
    private Client $client;

    public function __construct(string $host)
    {
        $this->client = new Client([
            'base_uri' => $host,
            RequestOptions::VERIFY => false,
            RequestOptions::TIMEOUT => 15
        ]);
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