<?php

namespace Zuske\AuthClient\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Zuske\AuthClient\Service\AuthServiceInterface;

class LoginGetAction
{
    public function __construct(private readonly AuthServiceInterface $authService,) {}

    #[Route('/login', methods: ['GET'])]
    public function __invoke(Request $request): RedirectResponse
    {
        return new RedirectResponse($this->authService->makeLogin($request->getPathInfo()));
    }
}