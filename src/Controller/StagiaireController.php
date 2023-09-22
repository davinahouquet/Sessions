<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Repository\SessionRepository;
use App\Repository\StagiaireRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function index(StagiaireRepository $stagiaireRepository): Response
    {

        $stagiaires = $stagiaireRepository->findAll();

        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires
        ]);
    }

    #[Route('/stagiaire/{id}', name: 'show_stagiaire')]
    public function show(Stagiaire $stagiaire, SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findAll(null, $stagiaire);

        return $this->render('stagiaire/show.html.twig', [
            'stagiaire' =>  $stagiaire,
            'sessions' => $sessions
        ]);
    }
}
