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

        return $this->render('formation/index.html.twig', [
            'formations' => $formations
        ]);
    }
    
        #[Route('/formation/new', name: 'new_formation')]
        public function new(Request $request, EntityManagerInterface $entityManager): Response
        {
            $formation = new Formation();
        
            $form = $this->createForm(FormationType::class, $formation);
            
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
        
                $formation = $form->getData();
                
                $entityManager->persist($formation);
                $entityManager->flush();
        
                return $this->redirectToRoute('app_formation');
            }
        
            return $this->render('formation/new.html.twig', [
                'formAddFormation' => $form
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
    
}
