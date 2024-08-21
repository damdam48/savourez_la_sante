<?php

namespace App\Controller\Frontend;

use App\Repository\CategorieRepository;
use App\Repository\Product\RecetteRepository as ProductRecetteRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class HomeController extends AbstractController
{
    private $recetteRepository;
    private $saisonRepository;
    private $categoriesRepository;

    public function __construct(ProductRecetteRepository $recetteRepository, SaisonRepository $saisonRepository, CategorieRepository $categoriesRepository)
    {
        $this->recetteRepository = $recetteRepository;
        $this->saisonRepository = $saisonRepository;
        $this->categoriesRepository = $categoriesRepository;
    }

    #[Route('', name: 'app.home', methods: ['GET'])]
    public function index(ProductRecetteRepository $recetteRepository): Response
    {

        $saisons = $this->saisonRepository->findAll();
        $categories = $this->categoriesRepository->findAll();
        $recettes = $recetteRepository->findBy([
            'online' => true
        ]);

        // Mélange les recettes aléatoirement
        shuffle($recettes);
    
        // Prend les 3 premières recettes après le mélange
        $recettesAleatoires = array_slice($recettes, 0, 3);
    
        return $this->render('Frontend/Home/index.html.twig', [
            'recettesAleatoires' => $recettesAleatoires,
            'recettes' => $recettes,
            'saisons' => $saisons,
            'categories' => $categories,
        ]);
    }
}
