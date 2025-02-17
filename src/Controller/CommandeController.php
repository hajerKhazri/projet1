<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\ProduitCategories;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande/{id}', name: 'commande_produit', methods: ['GET', 'POST'])]
    public function commander(ProduitCategories $produit, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $commande = new Commande();
            $commande->setProduit($produit);
            $commande->setQuantite($request->request->get('quantite', 1)); // Quantité par défaut : 1
            $commande->setDateCommande(new \DateTime());
            $commande->setStatut("En attente");

            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->redirectToRoute('confirmation_commande');
        }

        return $this->render('user/commande.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/commande/confirmation', name: 'confirmation_commande')]
    public function confirmation(): Response
    {
        return new Response('<h2>Commande confirmée !</h2><p>Merci pour votre achat.</p>');
    }
}
