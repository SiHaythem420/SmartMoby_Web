<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    public function searchUsers(string $term)
    {
        $qb = $this->createQueryBuilder('u')
            ->leftJoin('u.admins', 'a')
            ->leftJoin('u.organisateurs', 'o')
            ->leftJoin('u.conducteurs', 'c')
            ->where('u.nom LIKE :term')
            ->orWhere('u.prenom LIKE :term')
            ->orWhere('u.email LIKE :term')
            ->orWhere('u.nom_utilisateur LIKE :term')
            ->orWhere('u.role LIKE :term')
            ->orWhere('a.departement LIKE :term')
            ->orWhere('o.num_badge LIKE :term')
            ->orWhere('c.numero_permis LIKE :term')
            ->setParameter('term', '%'.$term.'%');

        return $qb->getQuery()->getResult();
    }
}
