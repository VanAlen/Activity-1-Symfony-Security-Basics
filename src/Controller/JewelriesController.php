<?php // src/Controller/JewelriesController.php
namespace App\Controller;

use App\Entity\Jewelries;
use App\Form\JewelriesType;
use App\Repository\JewelriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/jewelries')]
class JewelriesController extends AbstractController
{
    #[Route('/', name: 'app_jewelries_index', methods: ['GET'])]
    public function index(JewelriesRepository $repo): Response
    {
        return $this->render('jewelries/index.html.twig', [
            'jewelries' => $repo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jewelries_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $jewelry = new Jewelries();
        $form = $this->createForm(JewelriesType::class, $jewelry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move($this->getParameter('jewelry_images_directory'), $newFilename);
                $jewelry->setImage('uploads/jewelries/' . $newFilename);
            }

            $em->persist($jewelry);
            $em->flush();

            return $this->redirectToRoute('app_jewelries_index');
        }

        return $this->render('jewelries/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jewelries_show', methods: ['GET'])]
    public function show(Jewelries $jewelry): Response
    {
        return $this->render('jewelries/show.html.twig', [
            'jewelry' => $jewelry,
        ]);
    }
#[Route('/{id}/edit', name: 'app_jewelries_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Jewelries $jewelry, EntityManagerInterface $em): Response
{
    $oldImage = $jewelry->getImage();

    $form = $this->createForm(JewelriesType::class, $jewelry);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $imageFile = $form->get('image')->getData();

        if ($imageFile) {
            // Delete old image if it exists
            if ($oldImage && file_exists($this->getParameter('kernel.project_dir') . '/public/' . str_replace('public\\', '', $oldImage))) {
                unlink($this->getParameter('kernel.project_dir') . '/public/' . str_replace('public\\', '', $oldImage));
            }

            // Save new image
            $newFilename = uniqid() . '.' . $imageFile->guessExtension();
            $imageFile->move($this->getParameter('jewelry_images_directory'), $newFilename);
            $jewelry->setImage('public\\images\\jewelries\\' . $newFilename);
        } else {
            // Keep old image if no new file uploaded
            $jewelry->setImage($oldImage);
        }

        $em->flush();

        $this->addFlash('success', 'Jewelry updated successfully!');
        return $this->redirectToRoute('app_jewelries_index');
    }

    return $this->render('jewelries/edit.html.twig', [
        'form' => $form,
        'jewelry' => $jewelry,
    ]);
}


    #[Route('/{id}', name: 'app_jewelries_delete', methods: ['POST'])]
    public function delete(Request $request, Jewelries $jewelry, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $jewelry->getId(), $request->request->get('_token'))) {
            if ($jewelry->getImage() && file_exists($this->getParameter('kernel.project_dir') . '/public/' . $jewelry->getImage())) {
                unlink($this->getParameter('kernel.project_dir') . '/public/' . $jewelry->getImage());
            }

            $em->remove($jewelry);
            $em->flush();
        }

        return $this->redirectToRoute('app_jewelries_index');
    }
}
