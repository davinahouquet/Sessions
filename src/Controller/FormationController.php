<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormateurRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
    #[Route('/formation', name: 'app_formation')]
    public function index(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();
        // $formations = $formationRepository->findBy([], ["nomFormation" => "ASC"]);

        return $this->render('formation/index.html.twig', [
            'formations' => $formations
        ]);
    }
    
    #[Route('/admin/formation/new', name: 'new_formation')]
    #[Route('/admin/formation/{id}/new', name: 'edit_formation')]
    public function new_edit(Formation $formation = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        $isNew = !$formation;

        if ($isNew) {
            $formation = new Formation();
        }
        
        $form = $this->createForm(FormationType::class, $formation);
            
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        
            $formation = $form->getData();
                
            $entityManager->persist($formation);
            $entityManager->flush();
        
            $this->addFlash('message', 'La formation a bien été ajoutée/éditée');
            return $this->redirectToRoute('show_formation', ['id' => $formation->getId()]);
        }
        

        return $this->render('formation/new.html.twig', [
            'formAddFormation' => $form,
            'edit' => $formation->getId()
        ]);
    }

    #[Route('/formation/{id}', name: 'show_formation')]
    public function show(Formation $formation, FormateurRepository $formateurRepository): Response
    {

        $formateur = $formateurRepository->findOneBy([]);

        return $this->render('formation/show.html.twig', [
            'formation' =>  $formation,
            'formateur' => $formateur
        ]);
    }

    #[Route('/admin/formation/{id}/delete', name: 'delete_formation')]
    public function delete(Formation $formation = null, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($formation);
        $entityManager->flush();
            
        $this->addFlash('message', 'La formation a bien été supprimée');
        return $this->redirectToRoute(('app_formation'));
    }
    
}
