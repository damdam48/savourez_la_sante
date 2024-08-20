<?php

namespace App\Controller\Frontend;

use App\Repository\Product\RecetteRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaisonController extends AbstractController
{
    #[Route('/saison/{name}', name: 'app.saison', methods: ['GET'])]
    public function show(string $name, RecetteRepository $recetteRepository, SaisonRepository $saisonRepository): Response
    {
        $saison = $saisonRepository->findOneBy(['name' => $name]);
        if (!$saison) {
            throw $this->createNotFoundException('Saison non trouvée');
        }

        $recettes = $recetteRepository->findBy(['saison' => $saison]);

        return $this->render('Frontend/saison/index.html.twig', [
            'saison' => $saison,
            'recettes' => $recettes,
        ]);
    }
}

