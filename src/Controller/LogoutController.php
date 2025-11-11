<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController
{
    #[Route('/force-logout', name: 'force_logout')]
    public function logout(): Response
    {
        return new Response('Logged out', 401, ['WWW-Authenticate' => 'Basic realm="Logout"']);
    }
}
