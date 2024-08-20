<?php

namespace App\Controller\Frontend;

use App\Repository\Product\RecetteRepository as ProductRecetteRepository;
use App\Repository\RecetteRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    private $recetteRepository;
    private $saisonRepository;

    public function __construct(ProductRecetteRepository $recetteRepository, SaisonRepository $saisonRepository)
    {
        $this->recetteRepository = $recetteRepository;
        $this->saisonRepository = $saisonRepository;
    }

    #[Route('', name: 'app.home', methods: ['GET'])]
    public function index(): Response
    {
        // Utilisation des repositories injectés
        $recettes = $this->recetteRepository->findAll();
        $saisons = $this->saisonRepository->findAll();

        return $this->render('Frontend/Home/index.html.twig', [
            'controller_name' => 'HomeController',
            'recettes' => $recettes,
            'saisons' => $saisons,
        ]);
    }
}
