<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/admin/categorie/new', name: 'new_categorie')]
    #[Route('/admin/categorie/{id}/edit', name: 'edit_categorie')]
    public function new_edit(Categorie $categorie = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        $isNew = !$categorie;

        if ($isNew) {
            $categorie = new Categorie();
        }
    
        $form = $this->createForm(CategorieType::class, $categorie);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
            $categorie = $form->getData();
               
            $entityManager->persist($categorie);
            
            $entityManager->flush();
    
            $this->addFlash('message', 'La catégorie a bien été ajoutée');
            return $this->redirectToRoute('show_categorie', ['id' => $categorie->getId()]);
        }
    
        return $this->render('categorie/new.html.twig', [
            'formAddCategorie' => $form,
            'edit' => $categorie->getId()
            ]);
        }

    #[Route('/categorie/{id}', name: 'show_categorie')]
    public function show(Categorie $categorie): Response
    {
        if(!$categorie->getId()){
            return $this->redirectToRoute("app_home");
        } else {
            return $this->render('categorie/show.html.twig', [
                'categorie' =>  $categorie
            ]);
        }
    }

    #[Route('/admin/categorie/{id}/delete', name: 'delete_categorie')]
    public function delete(Categorie $categorie = null, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($categorie);
        $entityManager->flush();

        $this->addFlash('message', 'La catégorie a bien été supprimée');
        return $this->redirectToRoute(('app_categorie'));
    }
}
