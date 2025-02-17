<?php

namespace App\Controller;

use App\Entity\ProduitCategories;
use App\Form\ProduitCategoriesType;
use App\Repository\ProduitCategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProduitCategoriesController extends AbstractController
{
    #[Route('/produit_categories', name: 'produit_categories_index', methods: ['GET', 'post'])]
    public function index(ProduitCategoriesRepository $produitCategoriesRepository): Response
    {
        return $this->render('produit_categories/index.html.twig', [
            'produit_categories' => $produitCategoriesRepository->findAll(),
        ]);
    }
    #[Route('/ajouter-categorie', name: 'ajouter_categorie', methods: ['GET', 'POST'])]

    public function ajouterCategorie(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $categorie = new ProduitCategories();
        $form = $this->createForm(ProduitCategoriesType::class, $categorie);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
    
                try {
                    $imageFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $categorie->setImage($newFilename);
                    $this->addFlash('success', 'Image uploadée avec succès.');
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image.');
                }
            }
    
            $entityManager->persist($categorie);
            $entityManager->flush();
    
            $this->addFlash('success', 'Catégorie ajoutée avec succès !');
            return $this->redirectToRoute('produit_categories_index');
        }
    
        return $this->render('produit_categories/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/produit-categorie/{id}', name: 'produit_categorie_show', methods: ['GET'])]
    public function show(int $id, ProduitCategoriesRepository $produitCategoriesRepository): Response
    {
        $produitCategorie = $produitCategoriesRepository->find($id);

        if (!$produitCategorie) {
            throw $this->createNotFoundException("Catégorie introuvable.");
        }

        return $this->render('produit_categories/show.html.twig', [
            'produitCategorie' => $produitCategorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'produit_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProduitCategories $produitCategorie, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProduitCategoriesType::class, $produitCategories);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $produitCategorie->setImage($newFilename);
                    $this->addFlash('success', 'Image mise à jour avec succès.');
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image.');
                }
            }

            $entityManager->flush();
            $this->addFlash('success', 'Catégorie mise à jour avec succès !');

            return $this->redirectToRoute('produit_categories_index');
        }

        return $this->render('produit_categories/edit.html.twig', [
            'produit_categorie' => $produitCategorie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'produit_categories_delete', methods: ['POST'])]
    public function delete(Request $request, ProduitCategories $produitCategorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $produitCategorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produitCategorie);
            $entityManager->flush();
            $this->addFlash('success', 'Catégorie supprimée avec succès.');
        }

        return $this->redirectToRoute('produit_categories_index');
    }
}
