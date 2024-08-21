<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecetteCompleteController extends AbstractController
{
    #[Route('/frontend/recette/complete', name: 'app_frontend_recette_complete')]
    public function index(): Response
    {
        return $this->render('frontend/recette_complete/index.html.twig', [
            'controller_name' => 'RecetteCompleteController',
        ]);
    }
}
