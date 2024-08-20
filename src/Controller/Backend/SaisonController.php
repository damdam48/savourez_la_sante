<?php

namespace App\Controller\Backend;

use App\Form\SaisonType;
use App\Entity\Saison;
use App\Repository\SaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/admin/saison', name: 'admin.saison')]
class SaisonController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SaisonRepository $saisonRepository
    ) {
    }
// index

    #[Route('', name: '.index', methods: ['GET'])]
    public function index(): Response
    {
        $saisons = $this->saisonRepository->findAll();
        return $this->render('Backend/saison/index.html.twig', [
            'saisons' => $saisons,
        ]);
    }

// create
    #[Route('/create', name: '.create', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $saison = new Saison();

        $form = $this->createForm(SaisonType::class, $saison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($saison);
            $this->em->flush();

            $this->addFlash('success', 'La saison a bien été créée.');

            return $this->redirectToRoute('admin.saison.index');
        }

        return $this->render('Backend/saison/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
//update
    #[Route('/{id}/edit', name: '.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Saison $saison): Response
    {
        $form = $this->createForm(SaisonType::class, $saison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            $this->addFlash('success', 'La saison a bien été mise à jour.');

            return $this->redirectToRoute('admin.saison.index');
        }

        return $this->render('Backend/saison/edit.html.twig', [
            'form' => $form,
        ]);
    }

// delete
    #[Route('/{id}/delete', name: '.delete', methods: ['POST'])]
    public function delete(Request $request, Saison $saison): Response
    {
        if ($this->isCsrfTokenValid('delete' . $saison->getId(), $request->request->get('token'))) {
            $this->em->remove($saison);
            $this->em->flush();

            $this->addFlash('success', 'La saison a bien été supprimée.');
        }

        return $this->redirectToRoute('admin.saison.index');
    }

}