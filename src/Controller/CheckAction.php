<?php

namespace Zuske\AuthClient\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CheckAction
{
    #[Route('/check')]
    public function __invoke(Request $request)
    {
        if ($request->get('state') !== $request->getSession()->get('state')) {
            throw new \Exception('Unauthorized', 401);
        }

        return new RedirectResponse('/?code=' . $request->get('code'));
    }
}