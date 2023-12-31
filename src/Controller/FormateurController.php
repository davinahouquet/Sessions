<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Entity\Stagiaire;
use App\Form\FormateurType;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormateurController extends AbstractController
{
    #[Route('/user/formateur', name: 'app_formateur')]
    public function index(FormateurRepository $formateurRepository): Response
    {

        $formateurs = $formateurRepository->findAll();

        return $this->render('formateur/index.html.twig', [
            'formateurs' => $formateurs
        ]);
    }
    
    #[Route('/admin/formateur/new', name: 'new_formateur')]
    #[Route('/admin/formateur/{id}/edit', name: 'edit_formateur')]
    public function new_edit(Formateur $formateur = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        $isNew = !$formateur;

        if ($isNew) {
            $formateur = new Formateur();
        }
    
        $form = $this->createForm(FormateurType::class, $formateur);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
            $formateur = $form->getData();
               
            $entityManager->persist($formateur);
            
            $entityManager->flush();
    
            $this->addFlash('message', 'Le formateur a bien été ajouté');
            return $this->redirectToRoute('show_formateur', ['id' => $formateur->getId()]);
        }
    
        return $this->render('formateur/new.html.twig', [
            'formAddFormateur' => $form,
            'edit' => $formateur->getId()
            ]);
        }

    #[Route('/formateur/{id}', name: 'show_formateur')]
    public function show(Formateur $formateur): Response
    {
        return $this->render('formateur/show.html.twig', [
            'formateur' =>  $formateur
        ]);
    }

    #[Route('/admin/formateur/{id}/delete', name: 'delete_formateur')]
    public function delete(Formateur $formateur = null, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($formateur);
        $entityManager->flush();

        $this->addFlash('message', 'Le formateur a bien été supprimé');
        return $this->redirectToRoute(('app_formateur'));
    }
}
