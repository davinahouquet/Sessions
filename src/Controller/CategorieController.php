<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {

        $categories = $categorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' =>  $categories
        ]);
    }

    #[Route('/categorie/{id}', name: 'show_categorie')]
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' =>  $categorie
        ]);
    }
}
