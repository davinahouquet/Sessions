<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EmailFormType;
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
    
        #[Route('/user/editUserEmail/{id}', name: 'edit_user_email')]
        public function editEmail(User $user, Request $request, EntityManagerInterface $entityManager) : Response
        {
            // Si l'user n'existe pas redirection à home
            if(!$this->getUser()){
                return $this->redirectToRoute('app_login');
            }
        
            $email = $this->getUser()->getEmail();
    
            $form = $this->createForm(EmailFormType::class, $user);
    
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
    
    #[Route('/user/delete/{id}', name: 'delete_user')]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Supprime l'utilisateur de la base de données
        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'L\'utilisateur a été supprimé avec succès'
        );

        return $this->redirectToRoute('app_register');
    }
}
