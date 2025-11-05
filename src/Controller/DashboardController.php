<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard/contoller', name: 'app_dashboard_contoller')]
    public function index(): Response
    {
        return new Response("Welcome to dashboard! (Protected Area) ");
    }
}
