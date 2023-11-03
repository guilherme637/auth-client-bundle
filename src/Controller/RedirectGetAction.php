<?php

namespace Zuske\AuthClient\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Zuske\AuthClient\Service\AuthClientServiceInterface;

class RedirectGetAction
{
    public function __construct(private readonly AuthClientServiceInterface $authService) {}

    #[Route('/', methods: ['GET'])]
    public function __invoke(Request $request)
    {
        $this->authService->makeAuthentication($request->get('code'));

        return new RedirectResponse($this->authService->getRedirectRefer());
    }
}