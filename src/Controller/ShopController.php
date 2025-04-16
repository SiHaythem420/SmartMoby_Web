<?php

namespace App\Controller;

use App\Repository\TrajetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/front/shop', name: 'app_shop')]
    public function index(Request $request, TrajetRepository $trajetRepository): Response
    {
        // Get filter parameters from request
        $vehicleType = $request->query->get('vehicle_type');
        $timeFilter = $request->query->get('time');
        $priceRange = $request->query->get('price_range');
        $sortBy = $request->query->get('sort_by', 'time');
        $page = $request->query->getInt('page', 1);
        $itemsPerPage = 6; // Number of trips per page
        
        // Build query based on filters
        $queryBuilder = $trajetRepository->createQueryBuilder('t')
            ->leftJoin('t.vehicule', 'v');
        
        // Apply vehicle type filter
        if ($vehicleType) {
            $queryBuilder->andWhere('v.type = :vehicleType')
                ->setParameter('vehicleType', $vehicleType);
        }
        
        // Apply time filter
        if ($timeFilter) {
            $today = new \DateTime('today');
            $tomorrow = new \DateTime('tomorrow');
            
            switch ($timeFilter) {
                case 'today':
                    $queryBuilder->andWhere('t.dateDepart >= :todayStart')
                        ->andWhere('t.dateDepart < :tomorrowStart')
                        ->setParameter('todayStart', $today)
                        ->setParameter('tomorrowStart', $tomorrow);
                    break;
                case 'tomorrow':
                    $dayAfterTomorrow = new \DateTime('tomorrow +1 day');
                    $queryBuilder->andWhere('t.dateDepart >= :tomorrowStart')
                        ->andWhere('t.dateDepart < :dayAfterTomorrow')
                        ->setParameter('tomorrowStart', $tomorrow)
                        ->setParameter('dayAfterTomorrow', $dayAfterTomorrow);
                    break;
            }
        }
        
        // Apply price range filter
        if ($priceRange) {
            switch ($priceRange) {
                case 'under_10':
                    $queryBuilder->andWhere('t.prix < 10');
                    break;
                case '10_15':
                    $queryBuilder->andWhere('t.prix BETWEEN 10 AND 15');
                    break;
                case 'over_20':
                    $queryBuilder->andWhere('t.prix > 20');
                    break;
            }
        }
        
        // Apply sorting
        switch ($sortBy) {
            case 'price':
                $queryBuilder->orderBy('t.prix', 'ASC');
                break;
            case 'distance':
                $queryBuilder->orderBy('t.distance', 'ASC');
                break;
            case 'time':
            default:
                $queryBuilder->orderBy('t.dateDepart', 'ASC');
                break;
        }
        
        // Get total count for pagination
        $totalQuery = clone $queryBuilder;
        $totalItems = $totalQuery->select('COUNT(t.id)')
                                ->getQuery()
                                ->getSingleScalarResult();
        $totalPages = ceil($totalItems / $itemsPerPage);
        
        // Ensure page is within valid range
        $page = max(1, min($page, $totalPages));
        
        // Add pagination to query
        $queryBuilder->setFirstResult(($page - 1) * $itemsPerPage)
                    ->setMaxResults($itemsPerPage);
        
        // Get paginated results
        $trajets = $queryBuilder->getQuery()->getResult();
        
        return $this->render('shop.html.twig', [
            'trajets' => $trajets,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'vehicleType' => $vehicleType,
            'timeFilter' => $timeFilter,
            'priceRange' => $priceRange,
            'sortBy' => $sortBy
        ]);
    }
}