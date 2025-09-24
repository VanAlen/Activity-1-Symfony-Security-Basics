<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function dashboard(SessionInterface $session): Response
    {
        $user = $session->get('user');

        if (!$user) {
            // Not logged in -> go back to login
            return $this->redirectToRoute('login');
        }

        return $this->render('dashboard/index.html.twig', [
            'username' => $user['username'],
        ]);
    }
}
