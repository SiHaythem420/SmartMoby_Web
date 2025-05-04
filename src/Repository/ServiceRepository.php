<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }
    public function findByTerm(string $term): array
    {
        $qb = $this->createQueryBuilder('s')
            ->leftJoin('s.categorie', 'c')
            ->addSelect('c')
            ->where('s.nom         LIKE :t')
            ->orWhere('s.description LIKE :t')
            ->orWhere('c.nom         LIKE :t')
            ->setParameter('t', '%'.$term.'%')
            ->orderBy('s.id_service', 'ASC');

        return $qb->getQuery()->getResult();
    }

    // Add custom methods as needed
}