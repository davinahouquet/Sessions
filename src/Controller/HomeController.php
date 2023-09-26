<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(SessionRepository $sessionRepository): Response
    {
        // $sessions = $sessionRepository->findAll();
        $sessionsAVenir = $sessionRepository->findSessionsAVenir();
        $sessionsEnCours = $sessionRepository->findSessionsEnCours();
        $sessionsPassees = $sessionRepository->findSessionsPassees();


        // $nbInscrits = count($stagiaires);

        return $this->render('home/index.html.twig', [
            'sessionsEnCours' => $sessionsEnCours,
            'sessionsAVenir' =>  $sessionsAVenir,
            'sessionsPassees' => $sessionsPassees
        ]);
    }

}
