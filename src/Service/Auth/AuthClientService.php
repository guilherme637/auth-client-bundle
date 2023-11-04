<?php

namespace Zuske\AuthClient\Service\Auth;

use Auth\Token;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Zuske\AuthClient\Assembler\AuthServiceAssembler;
use Zuske\AuthClient\Exception\MakeLoginAgainException;
use Zuske\AuthClient\Security\OAuthClientInterface;
use Zuske\AuthClient\Service\Client\ClientAuthServiceInterface;
use Zuske\AuthClient\VO\TokenVO;

class AuthClientService implements AuthClientServiceInterface
{
    public function __construct(
        private readonly OAuthClientInterface $authClient,
        private ClientAuthServiceInterface    $clientAuthService,
    ) {}

    public function makeLogin(string $pathInfo, SessionInterface $session): string
    {
        $state = md5(rand(1000, 90000));
        $session->set('state', $state);
        $session->set('refer_', $pathInfo);

        return (new AuthServiceAssembler())->assemblerLogin($this->authClient, $state);
    }

    public function makeAuthentication(string $code, string $host = null): TokenVO
    {
        $tokenRequestDto = (new AuthServiceAssembler())->assemblerTokenPost($this->authClient, $code);

        try {
            $token = $this->clientAuthService->makePullToken($tokenRequestDto->toArray(), $host);
            $access_token = json_decode($token->getBody()->getContents(), true)['access_token'];
        } catch (\Throwable $exception) {
            if ($exception->getCode() === 400) {
                throw new MakeLoginAgainException();
            }

            throw $exception;
        }

        return new TokenVO(
            $access_token,
            Token::decrypt($access_token, $this->authClient->getResourceOwner())
        );
    }

    public function getRedirectRefer(SessionInterface $session): string
    {
        $refer = $session->get('refer_');

        $session->remove('refer_');
        $session->remove('state');

        return $refer;
    }
}