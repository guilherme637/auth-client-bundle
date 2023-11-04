<?php

namespace Zuske\AuthClient\Service\Auth;

use Auth\Token;
use Symfony\Component\HttpFoundation\RequestStack;
use Zuske\Adapter\Serializer\SerializerInterface;
use Zuske\AuthClient\Assembler\AuthServiceAssembler;
use Zuske\AuthClient\Exception\MakeLoginAgainException;
use Zuske\AuthClient\Security\OAuthClientInterface;
use Zuske\AuthClient\Service\Client\ClientAuthServiceInterface;

class AuthClientService implements AuthClientServiceInterface
{
    public function __construct(
        private readonly OAuthClientInterface $authServiceResolver,
        private RequestStack                  $requestStack,
        private ClientAuthServiceInterface    $clientAuthService,
    ) {}

    public function makeLogin(string $pathInfo): string
    {
        $state = md5(rand(1, 1000));
        $this->requestStack->getSession()->set('state', $state);
        $this->requestStack->getSession()->set('refer_', $pathInfo);

        return (new AuthServiceAssembler())->assemblerLogin($this->authServiceResolver, $pathInfo);
    }

    public function makeAuthentication(string $code): \stdClass
    {
        $tokenRequestDto = (new AuthServiceAssembler())->assemblerTokenPost($this->authServiceResolver, $code);

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

        return Token::decrypt($access_token, $this->authServiceResolver->getResourceOwner());
    }

    public function getRedirectRefer(): string
    {
        $refer = $this->requestStack->getSession()->get('refer_');

        $this->requestStack->getSession()->remove('refer_');
        $this->requestStack->getSession()->remove('state');

        return $this->authServiceResolver->getHost() . $refer;
    }
}