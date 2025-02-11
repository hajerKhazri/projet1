<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('app_admin'); // Redirection vers l'admin
            }
            if ($this->isGranted('ROLE_FOURNISSEUR')) {
                return $this->redirectToRoute('app_fournisseur'); // Redirection vers l'admin
            }
            if ($this->isGranted('ROLE_PSYCHIATRE')) {
                return $this->redirectToRoute('app_psychiatre'); // Redirection vers l'admin
            }
<<<<<<< HEAD
            if ($this->isGranted('ROLE_PATIENT')) {
                return $this->redirectToRoute('app_home'); // Redirection vers l'admin
            }
=======
<<<<<<< HEAD
=======
            if ($this->isGranted('ROLE_PATIENT')) {
                return $this->redirectToRoute('app_home'); // Redirection vers l'admin
            }
>>>>>>> f363561ac0fd018884919ad594c72da0d1a28970
>>>>>>> 5e3e6aa9089158b2b2a98b390e1ee91e6996ad2a
             return $this->redirectToRoute('app_home');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
    
}
