<?php

namespace App\Controller;

use App\Repository\ModuleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $moduleRepository): Response
    {

        $modules = $moduleRepository->findAll();

        return $this->render('module/index.html.twig', [
            'modules' => $modules,
        ]);
    }
}
