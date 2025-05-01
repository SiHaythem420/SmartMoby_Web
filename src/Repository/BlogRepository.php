<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    public function searchBlogs(?string $query = null, bool $featuredOnly = false, bool $recentFirst = true)
{
    $qb = $this->createQueryBuilder('b');
    
    if (!empty($query)) {
        $qb->andWhere('b.title LIKE :query OR b.content LIKE :query')
           ->setParameter('query', '%'.$query.'%');
    }
    
    if ($featuredOnly) {
        $qb->andWhere('b.isFeatured = :isFeatured')
           ->setParameter('isFeatured', true);
    }
    
    $order = $recentFirst ? 'DESC' : 'ASC';
    
    return $qb->orderBy('b.date', $order)
              ->addOrderBy('b.isFeatured', 'DESC')
              ->getQuery()
              ->getResult();
}

    // Add custom methods as needed
}