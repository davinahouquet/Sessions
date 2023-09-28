<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(SessionRepository $sessionRepository): Response
    {
        
        $sessions = $sessionRepository->findAll();

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions
        ]);
    }

    // Créer et modifier une session
    #[Route('/admin/session/new', name: 'new_session')]
    #[Route('/admin/session/{id}/edit', name: 'edit_session')]
    public function new_edit(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
    {

        $isNew = !$session;

        if ($isNew) {

            $session = new Session();
        }
    
        $form = $this->createForm(SessionType::class, $session);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
    
            $session = $form->getData();
            
            $entityManager->persist($session);
            $entityManager->flush();
    
            return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
        }
    
        return $this->render('session/new.html.twig', [
            'formAddSession' => $form,
            'edit' => $session->getId()
        ]);
    }

    // Afficher les détails d'une session, les stagaires non inscrits et les modules non programmés
    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session, SessionRepository $sr): Response
    {

        // $totalDuree = 0;
        // $duree = $programme->getDuree();
        // foreach($duree as $jours){
        //     $totalDuree = $jours ++;
        // }

        $session_id = $session->getId();
        $nonInscrits = $sr->findNonInscrits($session_id);
        $nonProgrammes = $sr->findNonProgrammes($session_id);

        return $this->render('session/show.html.twig', [
            'session' =>  $session,
            'nonInscrits' => $nonInscrits,
            'nonProgrammes' => $nonProgrammes
            // 'totalDuree' => $totalDuree
        ]);
    }

    // Supprimer une session
    #[Route('/admin/session/{id}/delete', name: 'delete_session')]
    public function delete(Session $session = null, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($session);
        $entityManager->flush();
            
        return $this->redirectToRoute(('app_session'));
    }

    // Ajouter un stagiaire à une session
    #[Route('/admin/session/{id}/{session}/add', name: 'add_stagiaire')]
    public function addStagiaire(Stagiaire $stagiaire, Session $session, EntityManagerInterface $entityManager)
    {
    
        $session->addStagiaire($stagiaire);
        
        $entityManager->persist($stagiaire);

        $entityManager->flush();

        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }

    // Supprimer un stagiaire d'une session
    #[Route('/admin/session/{id}/{session}/remove', name: 'remove_stagiaire')]
    public function removeStagiaire(Stagiaire $stagiaire, Session $session, EntityManagerInterface $entityManager)
    {
    
        $session->removeStagiaire($stagiaire);
        
        $entityManager->persist($stagiaire);

        $entityManager->flush();

        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }

    // Ajouter un programme dans le détail d'une session
    #[Route('/admin/session/{module}/{session}/add_programme', name: 'add_programme')]
    public function addProgramme(Request $request,Module $module, Session $session, EntityManagerInterface $entityManager)
    {
        $programme = new Programme();
        $programme->setSession($session);
        $programme->setModule($module);
        $duree = $request->request->get("duree");
        $programme->setDuree($duree);

        $session->addProgramme($programme);
        
        $entityManager->persist($programme);

        $entityManager->flush();

        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }

     // Remove un programme dans le détail d'une session
     #[Route('/admin/session/{module}/{session}/remove_programme', name: 'remove_programme')]
     public function removeProgramme(Module $module, Session $session, Programme $programme, EntityManagerInterface $entityManager)
     { 

        $session->removeProgramme($programme);
        
        $entityManager->flush();
    
        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }

}
