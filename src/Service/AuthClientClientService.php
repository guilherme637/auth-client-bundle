<?php

namespace Zuske\AuthClient\Service;

use App\Infrastructure\Client\ClientAuthServiceInterface;
use Auth\Token;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Zuske\Adapter\Redis\RedisAdapterInterface;
use Zuske\Adapter\Serializer\SerializerInterface;
use Zuske\AuthClient\Assembler\AuthServiceAssembler;
use Zuske\AuthClient\Exception\MakeLoginAgainException;
use Zuske\AuthClient\Security\AuthServiceResolverInterface;

class AuthClientClientService implements AuthClientServiceInterface
{
    public function __construct(
        private readonly AuthServiceResolverInterface $authServiceResolver,
        private SessionInterface $session,
        private SerializerInterface $serializer,
        private ClientAuthServiceInterface $clientAuthService,
        private RedisAdapterInterface $redisAdapter
    ) {}

    public function makeLogin(string $pathInfo): string
    {
        $state = md5(rand(1, 1000));
        $this->session->set('state', $state);
        $this->session->set('refer_', $pathInfo);

        return (new AuthServiceAssembler())->assemblerLogin($this->authServiceResolver, $pathInfo);
    }

    public function makeAuthentication(string $code): void
    {
        $tokenRequestDto = (new AuthServiceAssembler())->assemblerTokenPost($this->authServiceResolver, $code);
        $tokenRequest = $this->serializer->toArray($tokenRequestDto);

        try {
            $token = $this->clientAuthService->makePullToken($tokenRequest);
            $access_token = json_decode($token->getBody()->getContents(), true)['access_token'];
        } catch (\Throwable $exception) {
            if ($exception->getCode() === 400) {
                throw new MakeLoginAgainException();
            }

            if ($exception->getCode() === 500) {
                throw $exception;
            }
        }

        $userToken = Token::decrypt($access_token, $this->authServiceResolver->getResourceOwner())->sub;
        $user = $this->serializer->serialize((array) $userToken, 'json');

        $this->redisAdapter->setExpKey($userToken->email, 7200, $user);
    }

    public function getRedirectRefer(): string
    {
        $refer = $this->session->get('refer_');

        $this->session->remove('refer_');
        $this->session->remove('state');

        return $this->authServiceResolver->getHost() . $refer;
    }
}