<?php

namespace App\Repository;

use App\Entity\Evenment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenment::class);
    }


    public function searchEvents(string $query)
    {
        return $this->createQueryBuilder('e')
            ->where('e.nom LIKE :query')
            ->orWhere('e.lieu LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('e.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function searchAndSortEvents(string $query, string $sort)
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.nom LIKE :query')
            ->orWhere('e.lieu LIKE :query')
            ->setParameter('query', '%' . $query . '%');

        switch ($sort) {
            case 'date_asc':
                $qb->orderBy('e.date', 'ASC');
                break;
            case 'date_desc':
                $qb->orderBy('e.date', 'DESC');
                break;
            case 'nom_asc':
                $qb->orderBy('e.nom', 'ASC');
                break;
            case 'nom_desc':
                $qb->orderBy('e.nom', 'DESC');
                break;
            case 'lieu_asc':
                $qb->orderBy('e.lieu', 'ASC');
                break;
            case 'lieu_desc':
                $qb->orderBy('e.lieu', 'DESC');
                break;
            default:
                $qb->orderBy('e.date', 'DESC');
        }

        return $qb->getQuery()->getResult();
    }
  
    // Add custom methods as needed
}
