<?php

namespace Zuske\AuthClient\Service\Auth;

use Auth\Token;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Zuske\AuthClient\Assembler\AuthServiceAssembler;
use Zuske\AuthClient\Exception\MakeLoginAgainException;
use Zuske\AuthClient\Security\OAuthClientInterface;
use Zuske\AuthClient\Service\Client\ClientAuthServiceInterface;

class AuthClientService implements AuthClientServiceInterface
{
    public function __construct(
        private readonly OAuthClientInterface $authClient,
        private ClientAuthServiceInterface    $clientAuthService,
    ) {}

    public function makeLogin(string $pathInfo, SessionInterface $session): string
    {
        $state = md5(rand(1, 1000));
        $session->set('state', $state);
        $session->set('refer_', $pathInfo);

        return (new AuthServiceAssembler())->assemblerLogin($this->authClient, $pathInfo);
    }

    public function makeAuthentication(string $code): \stdClass
    {
        $tokenRequestDto = (new AuthServiceAssembler())->assemblerTokenPost($this->authClient, $code);

        try {
            $token = $this->clientAuthService->makePullToken($tokenRequestDto->toArray());
            $access_token = json_decode($token->getBody()->getContents(), true)['access_token'];
        } catch (\Throwable $exception) {
            if ($exception->getCode() === 400) {
                throw new MakeLoginAgainException();
            }

            if ($exception->getCode() === 500) {
                throw $exception;
            }
        }

        return Token::decrypt($access_token, $this->authClient->getResourceOwner());
    }

    public function getRedirectRefer(SessionInterface $session): string
    {
        $refer = $session->get('refer_');

        $session->remove('refer_');
        $session->remove('state');

        return $this->authClient->getHost() . $refer;
    }
}