<?php

namespace App\Controller\Backend;

use App\Form\RecetteType;
use App\Entity\Product\Recette;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\Product\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/recette', name: 'admin.recette')]
class RecetteController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly RecetteRepository $recetteRepository
    ) {
    }

    // index
    #[Route('', name: '.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('backend/recette/index.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }

    // create
    #[Route('/create', name: '.create', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $recette = new Recette();

        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($recette);
            $this->em->flush();

            $this->addFlash('success', 'La recette a bien été créée.');

            return $this->redirectToRoute('admin.recette.index');
        }

        return $this->render('backend/recette/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}