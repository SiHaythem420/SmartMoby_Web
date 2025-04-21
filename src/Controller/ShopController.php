<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Repository\TrajetRepository;
use App\Service\GoogleMapsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ShopController extends AbstractController
{
    private GoogleMapsService $googleMapsService;

    public function __construct(GoogleMapsService $googleMapsService)
    {
        $this->googleMapsService = $googleMapsService;
    }

    
    #[Route('/front/shop', name: 'app_shop')]
    public function index(Request $request, TrajetRepository $trajetRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $itemsPerPage = 9;
        
        // Get search parameters
        $departure = $request->query->get('departure');
        $arrival = $request->query->get('arrival');
        $vehicleType = $request->query->get('vehicle_type');
        $timeFilter = $request->query->get('time');
        $priceRange = $request->query->get('price_range');
        $sortBy = $request->query->get('sort_by', 'time');

        // Get advanced search parameters
        $dateFrom = $request->query->get('date_from');
        $dateTo = $request->query->get('date_to');
        $timeRange = $request->query->get('time_range');
        $vehicleTypes = $request->query->all('vehicle_types');
        $maxPrice = $request->query->get('max_price', 100);
        $maxStops = $request->query->get('max_stops');
        $minRating = $request->query->get('min_rating');

        // Get map-based search parameters
        $maxDistance = $request->query->get('max_distance', 50); // Default 50km radius

        // Build query based on filters
        $qb = $trajetRepository->createQueryBuilder('t')
            ->leftJoin('t.vehicule', 'v');

        // Apply map-based search if departure and arrival are provided
        if ($departure && $arrival) {
            // For now, we'll use a simple LIKE query
            // In a real application, you'd want to use geospatial queries
            $qb->andWhere('(LOWER(t.pointDepart) LIKE LOWER(:departure) OR LOWER(t.pointArrivee) LIKE LOWER(:departure))')
               ->andWhere('(LOWER(t.pointArrivee) LIKE LOWER(:arrival) OR LOWER(t.pointDepart) LIKE LOWER(:arrival))')
               ->setParameter('departure', '%' . $departure . '%')
               ->setParameter('arrival', '%' . $arrival . '%');
        }

        // Apply search filters with more flexible matching
        if ($departure) {
            $qb->andWhere('(LOWER(t.pointDepart) LIKE LOWER(:departure) OR LOWER(t.pointArrivee) LIKE LOWER(:departure))')
                ->setParameter('departure', '%' . $departure . '%');
        }
        
        if ($arrival) {
            $qb->andWhere('(LOWER(t.pointArrivee) LIKE LOWER(:arrival) OR LOWER(t.pointDepart) LIKE LOWER(:arrival))')
                ->setParameter('arrival', '%' . $arrival . '%');
        }

        // Apply vehicle type filter
        if ($vehicleType) {
            $qb->andWhere('v.type = :vehicleType')
                ->setParameter('vehicleType', $vehicleType);
        }

        // Apply time filter
        if ($timeFilter === 'today') {
            $today = new \DateTime();
            $qb->andWhere('t.dateDepart >= :todayStart')
                ->andWhere('t.dateDepart < :todayEnd')
                ->setParameter('todayStart', $today->format('Y-m-d 00:00:00'))
                ->setParameter('todayEnd', $today->format('Y-m-d 23:59:59'));
        } elseif ($timeFilter === 'tomorrow') {
            $tomorrow = (new \DateTime())->modify('+1 day');
            $qb->andWhere('t.dateDepart >= :tomorrowStart')
                ->andWhere('t.dateDepart < :tomorrowEnd')
                ->setParameter('tomorrowStart', $tomorrow->format('Y-m-d 00:00:00'))
                ->setParameter('tomorrowEnd', $tomorrow->format('Y-m-d 23:59:59'));
        }

        // Apply date range filter
        if ($dateFrom && $dateTo) {
            $qb->andWhere('t.dateDepart >= :dateFrom')
               ->andWhere('t.dateDepart <= :dateTo')
               ->setParameter('dateFrom', $dateFrom . ' 00:00:00')
               ->setParameter('dateTo', $dateTo . ' 23:59:59');
        }

        // Apply time range filter
        if ($timeRange) {
            switch ($timeRange) {
                case 'morning':
                    $qb->andWhere('TIME(t.dateDepart) >= :timeFrom')
                       ->andWhere('TIME(t.dateDepart) < :timeTo')
                       ->setParameter('timeFrom', '06:00:00')
                       ->setParameter('timeTo', '12:00:00');
                    break;
                case 'afternoon':
                    $qb->andWhere('TIME(t.dateDepart) >= :timeFrom')
                       ->andWhere('TIME(t.dateDepart) < :timeTo')
                       ->setParameter('timeFrom', '12:00:00')
                       ->setParameter('timeTo', '18:00:00');
                    break;
                case 'evening':
                    $qb->andWhere('TIME(t.dateDepart) >= :timeFrom')
                       ->andWhere('TIME(t.dateDepart) < :timeTo')
                       ->setParameter('timeFrom', '18:00:00')
                       ->setParameter('timeTo', '00:00:00');
                    break;
                case 'night':
                    $qb->andWhere('TIME(t.dateDepart) >= :timeFrom')
                       ->andWhere('TIME(t.dateDepart) < :timeTo')
                       ->setParameter('timeFrom', '00:00:00')
                       ->setParameter('timeTo', '06:00:00');
                    break;
            }
        }

        // Apply vehicle types filter
        if (!empty($vehicleTypes)) {
            $qb->andWhere('v.type IN (:vehicleTypes)')
               ->setParameter('vehicleTypes', $vehicleTypes);
        }

        // Apply price range filter
        if ($priceRange === 'under_10') {
            $qb->andWhere('t.prix < 10');
        } elseif ($priceRange === '10_15') {
            $qb->andWhere('t.prix >= 10 AND t.prix <= 15');
        } elseif ($priceRange === 'over_20') {
            $qb->andWhere('t.prix > 20');
        }

        // Apply stops filter
        if ($maxStops !== null && $maxStops !== '') {
            $qb->andWhere('t.numberOfStops <= :maxStops')
               ->setParameter('maxStops', $maxStops);
        }

        // Apply rating filter
        if ($minRating) {
            $qb->andWhere('t.rating >= :minRating')
               ->setParameter('minRating', $minRating);
        }

        // Apply sorting
        if ($sortBy === 'price') {
            $qb->orderBy('t.prix', 'ASC');
        } elseif ($sortBy === 'distance') {
            $qb->orderBy('t.distance', 'ASC');
        } else {
            $qb->orderBy('t.dateDepart', 'ASC');
        }

        // Get total count before pagination
        $totalQuery = clone $qb;
        $totalQuery->select('COUNT(t.id)');
        $totalItems = $totalQuery->getQuery()->getSingleScalarResult();

        // Get paginated results
        $qb->setFirstResult($itemsPerPage * ($page - 1))
            ->setMaxResults($itemsPerPage);
        
        $trajets = $qb->getQuery()->getResult();
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Get statistics
        $stats = $this->getTripStatistics($trajetRepository);

        // Add debug information
        $this->addFlash('info', sprintf('Found %d trips in total', $totalItems));

        return $this->render('shop.html.twig', [
            'trajets' => $trajets,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'vehicleType' => $vehicleType,
            'timeFilter' => $timeFilter,
            'priceRange' => $priceRange,
            'sortBy' => $sortBy,
            'departure' => $departure,
            'arrival' => $arrival,
            'totalItems' => $totalItems,
            'stats' => $stats,
            'google_maps_api_key' => $this->googleMapsService->getApiKey()
        ]);
    }

    private function getTripStatistics(TrajetRepository $trajetRepository): array
    {
        // Get most popular routes
        $popularRoutes = $trajetRepository->createQueryBuilder('t')
            ->select('t.pointDepart, t.pointArrivee, COUNT(t.id) as tripCount')
            ->groupBy('t.pointDepart, t.pointArrivee')
            ->orderBy('tripCount', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        // Get best value trips (price per km)
        $bestValueTrips = $trajetRepository->createQueryBuilder('t')
            ->select('t.pointDepart, t.pointArrivee, t.prix, t.distance, (t.prix/t.distance) as pricePerKm')
            ->orderBy('pricePerKm', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        // Get most frequent vehicle types
        $vehicleStats = $trajetRepository->createQueryBuilder('t')
            ->select('v.type, COUNT(t.id) as count')
            ->leftJoin('t.vehicule', 'v')
            ->groupBy('v.type')
            ->orderBy('count', 'DESC')
            ->getQuery()
            ->getResult();

        // Get average prices by vehicle type
        $priceStats = $trajetRepository->createQueryBuilder('t')
            ->select('v.type, AVG(t.prix) as avgPrice')
            ->leftJoin('t.vehicule', 'v')
            ->groupBy('v.type')
            ->getQuery()
            ->getResult();

        return [
            'popularRoutes' => $popularRoutes,
            'bestValueTrips' => $bestValueTrips,
            'vehicleStats' => $vehicleStats,
            'priceStats' => $priceStats
        ];
    }
}