<?php

namespace App\Controller\Frontend;

use App\Repository\CategorieRepository;
use App\Repository\Product\RecetteRepository as ProductRecetteRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class HomeController extends AbstractController
{
    private $recetteRepository;
    private $saisonRepository;
    private $categoriesRepository;
    private $cache;

    public function __construct(
        ProductRecetteRepository $recetteRepository,
        SaisonRepository $saisonRepository,
        CategorieRepository $categoriesRepository,
        CacheInterface $cache
    ) {
        $this->recetteRepository = $recetteRepository;
        $this->saisonRepository = $saisonRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->cache = $cache;
    }

    #[Route('/', name: 'app.home', methods: ['GET'])]
    public function index(): Response
    {
        $saisons = $this->saisonRepository->findBy([
            'online' => true
        ]);
        $categories = $this->categoriesRepository->findBy([
            'online' => true
        ]);
        
        // Récupérer les recettes aléatoires depuis le cache et les générer
        $recettesAleatoires = $this->cache->get('random_recettes', function (ItemInterface $item) {
            
            // $item->expiresAfter(12 * 60 * 60); // 12 heures en secondes
            $item->expiresAfter(60); // 1 minute en secondes
            
 
            $recettes = $this->recetteRepository->findBy([
                'online' => true
            ]);

            // Mélanger les recettes et sélectionner les 3 premières
            shuffle($recettes);
            return array_slice($recettes, 0, 3);
        });

        return $this->render('Frontend/Home/index.html.twig', [
            'recettesAleatoires' => $recettesAleatoires,
            'saisons' => $saisons,
            'categories' => $categories,
        ]);
    }

    #[Route('/recette/{id}', name: 'app.RecetteComplete', methods: ['GET'])]
    public function RecetteComplete(string $id, ProductRecetteRepository $recetteRepository): Response
    {
        $recette = $recetteRepository->find($id);

        if (!$recette) {
            throw $this->createNotFoundException('Recette non trouvée');
        }

        return $this->render('Frontend/Home/RecetteComplete.html.twig', [
            'recette' => $recette,
        ]);
    }
}
