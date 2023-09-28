<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        // $user = $userRepository->findOneBy(['id']);

        return $this->render('user/index.html.twig', [
            // 'user' => $user
        ]);
    }

    #[Route('/user/editUser/{id}', name: 'edit_user')]
    public function edit(User $user, Request $request, EntityManagerInterface $entityManager) : Response
    {
        
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
    
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Les informations de votre compte ont bien été modifiées'
            ); 
            return $this->redirectToRoute('app_user');
        }


        return $this->render('user/edit.html.twig', [
            'form' => $form
        ]);
    }
    
}
