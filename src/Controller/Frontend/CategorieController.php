<?php

namespace App\Controller\Frontend;

use App\Repository\Product\RecetteRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie/{name}', name: 'app.categorie', methods: ['GET'])]
    
    public function show(string $name, RecetteRepository $recetteRepository, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findOneBy([
            'name' => $name
        ]);
        
        if (!$categorie) {
            throw $this->createNotFoundException('Categorie non trouvée');
        }

        $recettes = $recetteRepository->findBy([
            'categorie' => $categorie,
            'online' => true
        ],
            ['createdAt' => 'DESC']       // Tri par date de création, décroissant
        );

        return $this->render('Frontend/categorie/index.html.twig', [
            'categorie' => $categorie,
            'recettes' => $recettes,
        ]);
    }
}


