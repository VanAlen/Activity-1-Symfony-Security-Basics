<?php

namespace App\Controller;

use App\Entity\Gembundles;
use App\Form\GembundlesType;
use App\Repository\GembundlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gembundles')]
final class GembundlesController extends AbstractController
{
    #[Route('/', name: 'app_gembundles_index', methods: ['GET'])]
    public function index(GembundlesRepository $repo): Response
    {
        return $this->render('gembundles/index.html.twig', [
            'gembundles' => $repo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gembundles_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $em): Response
{
    $gembundle = new Gembundles();
    $form = $this->createForm(GembundlesType::class, $gembundle);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $imageFile = $form->get('image')->getData();

        if ($imageFile) {
            $newFilename = uniqid() . '.' . $imageFile->guessExtension();
            $imageFile->move($this->getParameter('bundles_images_directory'), $newFilename);
            $gembundle->setImage('images/bundles/' . $newFilename);
        }

        $gembundle->setCreatedAt(new \DateTimeImmutable());
        $em->persist($gembundle);
        $em->flush();

        return $this->redirectToRoute('app_gembundles_index');
    }

    return $this->render('gembundles/new.html.twig', [
        'gembundle' => $gembundle,
        'form' => $form,
    ]);
}

    #[Route('/{id}', name: 'app_gembundles_show', methods: ['GET'])]
    public function show(Gembundles $gembundle): Response
    {
        return $this->render('gembundles/show.html.twig', [
            'gembundle' => $gembundle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gembundles_edit', methods: ['GET', 'POST'])]
public function edit(int $id, Request $request, GembundlesRepository $repo, EntityManagerInterface $em): Response
{
    $gembundle = $repo->find($id);
    if (!$gembundle) {
        throw $this->createNotFoundException('Gembundle not found');
    }

    $oldImage = $gembundle->getImage();
    $form = $this->createForm(GembundlesType::class, $gembundle);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
    $imageFile = $form->get('image')->getData();

    if ($imageFile) {
        if ($oldImage && file_exists($this->getParameter('kernel.project_dir') . '/public/' . $oldImage)) {
            unlink($this->getParameter('kernel.project_dir') . '/public/' . $oldImage);
        }

        $newFilename = uniqid() . '.' . $imageFile->guessExtension();
        $imageFile->move($this->getParameter('bundles_images_directory'), $newFilename);
        $gembundle->setImage('images/bundles/' . $newFilename);
    } else {
        $gembundle->setImage($oldImage);
    }


        $em->flush();
        return $this->redirectToRoute('app_gembundles_index');
    }

    return $this->render('gembundles/edit.html.twig', [
        'gembundle' => $gembundle,
        'form' => $form,
    ]);
}


    #[Route('/{id}/delete', name: 'app_gembundles_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, GembundlesRepository $repo, EntityManagerInterface $em): Response
    {
        $gembundle = $repo->find($id);
        if (!$gembundle) {
            throw $this->createNotFoundException('Gembundle not found');
        }

        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $em->remove($gembundle);
            $em->flush();
        }

        return $this->redirectToRoute('app_gembundles_index');
    }
}
