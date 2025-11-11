<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\JewelriesRepository;
use App\Repository\GembundlesRepository;
use App\Repository\CustomjewelriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_index')]
    public function index(
        ProductRepository $productRepo,
        JewelriesRepository $jewelryRepo,
        GembundlesRepository $bundleRepo,
        CustomjewelriesRepository $customRepo
    ): Response {
        $gemCount = $productRepo->count([]);
        $jewelryCount = $jewelryRepo->count([]);
        $bundleCount = $bundleRepo->count([]);
        $customCount = $customRepo->count([]);

        return $this->render('admin.html.twig', [
            'gemCount' => $gemCount,
            'jewelryCount' => $jewelryCount,
            'bundleCount' => $bundleCount,
            'customCount' => $customCount,
        ]);
    }
}
