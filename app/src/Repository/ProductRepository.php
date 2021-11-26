<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
    
    /**
     * Get products list ordered by name
     */
    public function getProductsOrderByName() {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Product p
            ORDER BY p.name ASC'
        );

        return $query->getResult();
    }
}
