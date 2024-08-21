<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategorieController extends AbstractController
{
    #[Route('/backend/categorie', name: 'app_backend_categorie')]
    public function index(): Response
    {
        return $this->render('backend/categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
}
