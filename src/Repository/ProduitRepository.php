<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }
    public function findByTerm(string $term): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.services', 's')
            ->addSelect('s')
            ->where('p.nom   LIKE :t')
            ->orWhere('p.type  LIKE :t')
            ->orWhere('s.nom   LIKE :t')
            ->setParameter('t', '%'.$term.'%')
            ->orderBy('p.idproduit', 'ASC');

        return $qb->getQuery()->getResult();
    }

    // Add custom methods as needed
}