<?php
// src/Controller/RegisterController.php

namespace App\Controller;
use App\Entity\ProfilUtilisateur;
use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['GET','POST'])]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            $user = $form->getData();
            $plainPass = $user->getPassword();
           $passHash =  $passwordHasher->hashPassword($user,$plainPass);
           $user->setPassword($passHash);
            // echo $plainPass; exit;
            // print_r($user); exit
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre compte a bien été créé.'
            );

            return $this->redirectToRoute('login');
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
