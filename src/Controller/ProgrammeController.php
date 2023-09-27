<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ProgrammeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgrammeController extends AbstractController
{
    #[Route('/programme', name: 'app_programme')]
    public function index(ProgrammeRepository $programmeRepository): Response
    {

        $programmes = $programmeRepository->findAll();

        return $this->render('programme/index.html.twig', [
            'programmes' => $programmes
        ]);
    }
    
    #[Route('/admin/programme/new', name: 'new_programme')]
    #[Route('/admin/programme/{id}/edit', name: 'edit_programme')]
    public function new_edit(Programme $programme = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        $isNew = !$programme;

        if ($isNew) {
            $programme = new Programme();
        }
    
        $form = $this->createForm(ProgrammeType::class, $programme);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
            $programme = $form->getData();
               
            $entityManager->persist($programme);
            
            $entityManager->flush();
    
            return $this->redirectToRoute('app_programme');
        }
    
        return $this->render('programme/new.html.twig', [
            'formAddProgramme' => $form,
            'edit' => $programme->getId()
            ]);
    }

    #[Route('/admin/programme/{id}/delete', name: 'delete_programme')]
    public function delete(Programme $programme = null, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($programme);
        $entityManager->flush();

        return $this->redirectToRoute(('app_programme'));
    }

}
