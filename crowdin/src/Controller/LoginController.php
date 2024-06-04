<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('register/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }
    #[Route('/logout', name: 'logout', methods: ['GET', 'POST'])]
    public function logout(): Response
    {
        return $this->redirectToRoute('/home');
    }
    
  
}
