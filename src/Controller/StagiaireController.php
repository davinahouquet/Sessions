<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Service\PdfService;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/admin/stagiaire/new', name: 'new_stagiaire')]
    #[Route('/admin/stagiaire/{id}/edit', name: 'edit_stagiaire')]
    public function new_edit(Stagiaire $stagiaire = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        $isNew = !$stagiaire;

        if ($isNew) {
            $stagiaire = new Stagiaire();
        }
    
        $form = $this->createForm(StagiaireType::class, $stagiaire);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
            $stagiaire = $form->getData();
               
            $entityManager->persist($stagiaire);
            
            $entityManager->flush();
    
            $this->addFlash('message', 'Le stagiaire a bien été ajouté/édité');
            return $this->redirectToRoute('show_stagiaire', ['id' => $stagiaire->getId()]);
        }
    
        return $this->render('stagiaire/new.html.twig', [
            'formAddStagiaire' => $form,
            'edit' => $stagiaire->getId()
            ]);
        }

    #[Route('/admin/stagiaire/{id}/delete', name: 'delete_stagiaire')]
    public function delete(Stagiaire $stagiaire = null, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($stagiaire);
        $entityManager->flush();
            
        $this->addFlash('message', 'Le stagiaire a bien été supprimé');
        return $this->redirectToRoute(('app_stagiaire'));
    }

    #[Route('/stagiaire/{id}', name: 'show_stagiaire')]
    public function show(Stagiaire $stagiaire): Response
    {
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire' =>  $stagiaire
        ]);
    }

    #[Route('/admin/stagiaire', name: 'app_stagiaire')]
    public function index(StagiaireRepository $stagiaireRepository): Response
    {
        $stagiaires = $stagiaireRepository->findAll();

        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires
        ]);
    }

    #[Route('stagiaire/pdf/{id}', name: 'stagiaire.pdf')]
    public function generatePdfStagiaire(Stagiaire $stagiaire = null,  PdfService $pdf){
        $html = $this->render('stagiaire/show.html.twig', ['stagiaire' => $stagiaire]);
        $pdf->showPdfFile($html);
    }
}
