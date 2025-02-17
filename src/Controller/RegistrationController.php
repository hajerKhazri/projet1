<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Psychiatre;
use App\Entity\Patient;
use App\Entity\Fournisseur;
use App\Form\RegistrationFormType;
use App\Form\FournisseurType;
use App\Form\PatientType;
use App\Form\PsychiatreType;

use App\Security\SecurityAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new Psychiatre();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setSpecialite('S');
            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $security->login($user, SecurityAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
            'firstName' => $form->get('firstName')->createView(),
            'lastName' => $form->get('lastName')->createView(),
            'email' => $form->get('email')->createView(),
            'plainPassword' => $form->get('plainPassword')->createView(),
            'agreeTerms' => $form->get('agreeTerms')->createView(),
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function registerPatient(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new Patient();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setDossierMedical('doss');
            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $security->login($user, SecurityAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
            'firstName' => $form->get('firstName')->createView(),
            'lastName' => $form->get('lastName')->createView(),
            'email' => $form->get('email')->createView(),
            'plainPassword' => $form->get('plainPassword')->createView(),
            'agreeTerms' => $form->get('agreeTerms')->createView(),
        ]);
    }
    #[Route('/register', name: 'app_register')]
    public function registerFournisseur(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new Fournisseur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setEtat('true');
            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $security->login($user, SecurityAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
            'firstName' => $form->get('firstName')->createView(),
            'lastName' => $form->get('lastName')->createView(),
            'email' => $form->get('email')->createView(),
            'plainPassword' => $form->get('plainPassword')->createView(),
            'agreeTerms' => $form->get('agreeTerms')->createView(),
        ]);
    }
}
