<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/admin/module/new', name: 'new_module')]
    #[Route('/admin/module/{id}/edit', name: 'edit_module')]
    public function new_edit(Module $module = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        $isNew = !$module;

        if ($isNew) {
            $module = new Module();
        }
    
        $form = $this->createForm(ModuleType::class, $module);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
            $module = $form->getData();
               
            $entityManager->persist($module);
            
            $entityManager->flush();
    
            $this->addFlash('message', 'Le module a bien été ajouté/édité');
            return $this->redirectToRoute('show_module', ['id' => $module->getId()]);
        }
    
        return $this->render('module/new.html.twig', [
            'formAddModule' => $form,
            'edit' => $module->getId()
            ]);
    }

    #[Route('/module/{id}', name: 'show_module')]
    public function show(Module $module): Response
    {
        return $this->render('module/show.html.twig', [
            'module' =>  $module
        ]);
    }

    #[Route('/admin/module/{id}/delete', name: 'delete_module')]
    public function delete(Module $module = null, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($module);
        $entityManager->flush();

        $this->addFlash('message', 'Le module a bien été supprimé');
        return $this->redirectToRoute(('app_module'));
    }
}
