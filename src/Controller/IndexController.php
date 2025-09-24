<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function login(Request $request, SessionInterface $session): Response
    {
        $error = null; // variable for error message

        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            $user = $session->get('user');

            if ($user && $user['username'] === $username && $user['password'] === $password) {
                // Login successful -> redirect to dashboard
                return $this->redirectToRoute('dashboard');
            } else {
                // Set error message (only one per attempt)
                $error = 'Invalid username or password!';
            }
        }

        return $this->render('home/index.html.twig', [
            'error' => $error,
        ]);
    }
}
