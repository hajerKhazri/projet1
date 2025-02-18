<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;


final class PatientController extends AbstractController{
    #[Route('/patient', name: 'app_patient')]
    public function index(): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'PatientController',
        ]);
    }

    #[Route('/patient/produit', name: 'produit_index_patient', methods: ['GET'])]
    public function indexproduit(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager->getRepository(Produit::class)->findAll();

        return $this->render('produit/index_patient.html.twig', [
            'produits' => $produits,
        ]);
    }
}
