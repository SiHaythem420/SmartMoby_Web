<?php

namespace App\Repository;

use App\Entity\Trajet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

class TrajetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trajet::class);
    }

    public function findByPointArriveeAndDate(string $location, \DateTimeInterface $date)
    {
        try {
            // Create start and end of day for the given date
            $startOfDay = clone $date;
            $startOfDay->setTime(0, 0, 0);
            
            $endOfDay = clone $date;
            $endOfDay->setTime(23, 59, 59);

            return $this->createQueryBuilder('t')
                ->leftJoin('t.vehicule', 'v')
                ->andWhere('t.pointArrivee = :location')
                ->andWhere('t.dateDepart BETWEEN :startOfDay AND :endOfDay')
                ->andWhere('t.dateDepart > :now')
                ->andWhere('v.capacite > 0')
                ->setParameter('location', $location)
                ->setParameter('startOfDay', $startOfDay)
                ->setParameter('endOfDay', $endOfDay)
                ->setParameter('now', new \DateTime())
                ->orderBy('t.dateDepart', 'ASC')
                ->getQuery()
                ->getResult();
        } catch (\Exception $e) {
            throw new \Exception('Error finding trips by arrival point: ' . $e->getMessage());
        }
    }

    public function findByPointDepartAndDate(string $location, \DateTimeInterface $date)
    {
        try {
            // Create start and end of day for the given date
            $startOfDay = clone $date;
            $startOfDay->setTime(0, 0, 0);
            
            $endOfDay = clone $date;
            $endOfDay->setTime(23, 59, 59);

            return $this->createQueryBuilder('t')
                ->leftJoin('t.vehicule', 'v')
                ->andWhere('t.pointDepart = :location')
                ->andWhere('t.dateDepart BETWEEN :startOfDay AND :endOfDay')
                ->andWhere('t.dateDepart > :now')
                ->andWhere('v.capacite > 0')
                ->setParameter('location', $location)
                ->setParameter('startOfDay', $startOfDay)
                ->setParameter('endOfDay', $endOfDay)
                ->setParameter('now', new \DateTime())
                ->orderBy('t.dateDepart', 'ASC')
                ->getQuery()
                ->getResult();
        } catch (\Exception $e) {
            throw new \Exception('Error finding trips by departure point: ' . $e->getMessage());
        }
    }

    // Add custom methods as needed
}