<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\JewelrySearchType;
use App\Repository\ProductRepository;
use App\Repository\JewelriesRepository;

final class LandingController extends AbstractController
{
    #[Route('/landing', name: 'app_landing')]
    public function index(
        Request $request,
        ProductRepository $gemRepository,
        JewelriesRepository $jewelryRepository
    ): Response {
        $form = $this->createForm(JewelrySearchType::class);

        $gems = $gemRepository->findBy([], null, 3);
        $jewelries = $jewelryRepository->findBy([], null, 3);

        return $this->render('landing/index.html.twig', [
            'form' => $form->createView(),
            'gems' => $gems,
            'jewelries' => $jewelries,
        ]);
    }
}
