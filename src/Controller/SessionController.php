<?php

namespace App\Controller;

use App\Entity\Session;
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
    
            return $this->redirectToRoute('app_session');
        }
    
        return $this->render('session/new.html.twig', [
            'formAddSession' => $form,
            'edit' => $session->getId()
        ]);
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session, SessionRepository $sr): Response
    {
        $session_id = $session->getId();
        $nonInscrits = $sr->findNonInscrits($session_id);
        // $nonProgrammes = $sr->findNonProgrammes($session_id);

        return $this->render('session/show.html.twig', [
            'session' =>  $session,
            'nonInscrits' => $nonInscrits
        ]);
    }

    #[Route('/admin/session/{id}/delete', name: 'delete_session')]
    public function delete(Session $session = null, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($session);
        $entityManager->flush();
            
        return $this->redirectToRoute(('app_session'));
    }



}
