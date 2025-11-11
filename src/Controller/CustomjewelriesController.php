<?php

namespace App\Controller;

use App\Entity\Customjewelries;
use App\Form\CustomjewelriesType;
use App\Repository\CustomjewelriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CustomjewelriesController extends AbstractController
{
    #[Route('/customjewelries', name: 'app_customjewelries_index', methods: ['GET'])]
    public function index(CustomjewelriesRepository $repo): Response
    {
        return $this->render('customjewelries/index.html.twig', [
            'customjewelries' => $repo->findAll(),
        ]);
    }

   #[Route('/customjewelries/new', name: 'app_customjewelries_new', methods: ['GET', 'POST'])]
public function new(Request $request, CustomjewelriesRepository $repo): Response
{
    // Check if user is logged in
    if (!$this->getUser()) {
        $this->addFlash('error', 'You are not logged in! Please log in to create custom jewelry.');
        return $this->redirectToRoute('login'); // Or wherever you want to send them
    }

    $customjewelry = new Customjewelries();
    $form = $this->createForm(CustomjewelriesType::class, $customjewelry);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $imageFile = $form->get('imagepath')->getData();
        if ($imageFile) {
            $newFilename = uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move($this->getParameter('uploads_directory'), $newFilename);
            $customjewelry->setImagepath('uploads/'.$newFilename);
        }

        $customjewelry->setCreatedAt(new \DateTimeImmutable());
        $customjewelry->setCustomer($this->getUser());

        $repo->save($customjewelry, true);

        $this->addFlash('success', 'Custom jewelry created successfully!');
        return $this->redirectToRoute('app_customjewelries_index');
    }

    return $this->render('customjewelries/new.html.twig', [
        'form' => $form,
    ]);
}



    #[Route('/customjewelries/{id}/edit', name: 'app_customjewelries_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Customjewelries $customjewelry, CustomjewelriesRepository $repo): Response
    {
        $oldImage = $customjewelry->getImagepath();

        $form = $this->createForm(CustomjewelriesType::class, $customjewelry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imagepath')->getData();

            if ($imageFile) {
                // Delete old image if it exists
                if ($oldImage && file_exists($this->getParameter('kernel.project_dir').'/public/'.$oldImage)) {
                    unlink($this->getParameter('kernel.project_dir').'/public/'.$oldImage);
                }

                // Save new image
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move($this->getParameter('uploads_directory'), $newFilename);
                $customjewelry->setImagepath('uploads/'.$newFilename);
            } else {
                // Keep old image if no new file uploaded
                $customjewelry->setImagepath($oldImage);
            }

            $repo->save($customjewelry, true);

            $this->addFlash('success', 'Custom jewelry updated successfully!');
            return $this->redirectToRoute('app_customjewelries_index');
        }

        return $this->render('customjewelries/edit.html.twig', [
            'form' => $form,
            'customjewelry' => $customjewelry,
        ]);
    }

    #[Route('/customjewelries/{id}', name: 'app_customjewelries_show', methods: ['GET'])]
    public function show(Customjewelries $customjewelry): Response
    {
        return $this->render('customjewelries/show.html.twig', [
            'customjewelry' => $customjewelry,
        ]);
    }

    #[Route('/customjewelries/{id}', name: 'app_customjewelries_delete', methods: ['POST'])]
    public function delete(Request $request, Customjewelries $customjewelry, CustomjewelriesRepository $repo): Response
    {
        if ($this->isCsrfTokenValid('delete' . $customjewelry->getId(), $request->request->get('_token'))) {

            // Delete image file too
            if ($customjewelry->getImagepath() && file_exists($this->getParameter('kernel.project_dir').'/public/'.$customjewelry->getImagepath())) {
                unlink($this->getParameter('kernel.project_dir').'/public/'.$customjewelry->getImagepath());
            }

            $repo->remove($customjewelry, true);
            $this->addFlash('success', 'Custom jewelry deleted successfully!');
        }

        return $this->redirectToRoute('app_customjewelries_index');
    }
}
