<?php

namespace App\Controller\Backend;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/admin/categorie', name: 'admin.categorie')]
class CategorieController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly CategorieRepository $categorieRepository
    ) {
    }
// index

    #[Route('', name: '.index', methods: ['GET'])]
    public function index(): Response
    {
        $categories = $this->categorieRepository->findAll();
        return $this->render('Backend/categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

// create
    #[Route('/create', name: '.create', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($categorie);
            $this->em->flush();

            $this->addFlash('success', 'La categorie a bien été créée.');

            return $this->redirectToRoute('admin.categorie.index');
        }

        return $this->render('Backend/categorie/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
//update
    #[Route('/{id}/edit', name: '.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            $this->addFlash('success', 'La categorie a bien été mise à jour.');

            return $this->redirectToRoute('admin.categorie.index');
        }

        return $this->render('Backend/categorie/edit.html.twig', [
            'form' => $form,
        ]);
    }

// delete
    #[Route('/{id}/delete', name: '.delete', methods: ['POST'])]
    public function delete(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categorie->getId(), $request->request->get('token'))) {
            $this->em->remove($categorie);
            $this->em->flush();

            $this->addFlash('success', 'La categorie a bien été supprimée.');
        }

        return $this->redirectToRoute('admin.categorie.index');
    }

}