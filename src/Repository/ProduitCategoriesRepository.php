<?php

namespace App\Repository;


use App\Entity\ProduitCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProduitCategories>
 *
 * @method ProduitCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitCategories[]    findAll()
 * @method ProduitCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitCategories::class);
    }

    // Ici, tu peux ajouter d'autres méthodes personnalisées si nécessaire.
}
