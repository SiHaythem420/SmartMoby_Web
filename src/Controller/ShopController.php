<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Repository\TrajetRepository;
use App\Service\GoogleMapsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Service\WeatherService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VehicleRepository;

class ShopController extends AbstractController
{
    private GoogleMapsService $googleMapsService;
    private WeatherService $weatherService;
    private PaginatorInterface $paginator;

    public function __construct(GoogleMapsService $googleMapsService, WeatherService $weatherService, PaginatorInterface $paginator)
    {
        $this->googleMapsService = $googleMapsService;
        $this->weatherService = $weatherService;
        $this->paginator = $paginator;
    }

    
    #[Route('/front/shop', name: 'app_shop')]
    public function index(
        Request $request,
        TrajetRepository $trajetRepository
    ): Response {
        try {
            // Get filter parameters
            $vehicleType = $request->query->get('vehicle_type');
            $timeFilter = $request->query->get('time', 'all');
            $priceRange = $request->query->get('price_range');
            $sortBy = $request->query->get('sort_by', 'time');
            $page = $request->query->getInt('page', 1);
            
            // Advanced search parameters
            $departure = $request->query->get('departure');
            $arrival = $request->query->get('arrival');
            $dateFrom = $request->query->get('date_from');
            $dateTo = $request->query->get('date_to');
            $timeRange = $request->query->get('time_range');
            $vehicleTypes = $request->query->all('vehicle_types');
            $maxPrice = $request->query->get('max_price');
            $maxStops = $request->query->get('max_stops');

            // Create query builder
            $qb = $trajetRepository->createQueryBuilder('t')
                ->leftJoin('t.vehicule', 'v');

            // Apply basic filters
            if ($vehicleType) {
                $qb->andWhere('v.type = :vehicleType')
                    ->setParameter('vehicleType', $vehicleType);
            }

            // Apply advanced search filters
            if (!empty($vehicleTypes)) {
                $qb->andWhere('v.type IN (:vehicleTypes)')
                    ->setParameter('vehicleTypes', $vehicleTypes);
            }

            if ($dateFrom) {
                try {
                    $dateFromObj = new \DateTime($dateFrom);
                    $dateFromObj->setTime(0, 0, 0);
                    $qb->andWhere('t.dateDepart >= :dateFrom')
                        ->setParameter('dateFrom', $dateFromObj);
                } catch (\Exception $e) {
                    // Invalid date format, skip this filter
                }
            }

            if ($dateTo) {
                try {
                    $dateToObj = new \DateTime($dateTo);
                    $dateToObj->setTime(23, 59, 59);
                    $qb->andWhere('t.dateDepart <= :dateTo')
                        ->setParameter('dateTo', $dateToObj);
                } catch (\Exception $e) {
                    // Invalid date format, skip this filter
                }
            }

            if ($timeRange) {
                switch ($timeRange) {
                    case 'morning':
                        $qb->andWhere('HOUR(t.dateDepart) BETWEEN 6 AND 12');
                        break;
                    case 'afternoon':
                        $qb->andWhere('HOUR(t.dateDepart) BETWEEN 12 AND 18');
                        break;
                    case 'evening':
                        $qb->andWhere('HOUR(t.dateDepart) BETWEEN 18 AND 24');
                        break;
                    case 'night':
                        $qb->andWhere('HOUR(t.dateDepart) BETWEEN 0 AND 6');
                        break;
                }
            }

            if ($maxPrice && is_numeric($maxPrice)) {
                $qb->andWhere('t.prix <= :maxPrice')
                    ->setParameter('maxPrice', floatval($maxPrice));
            }

            if ($maxStops !== null && $maxStops !== '' && is_numeric($maxStops)) {
                $qb->andWhere('t.nombreArrets <= :maxStops')
                    ->setParameter('maxStops', intval($maxStops));
            }

            // Apply location filters
            if ($departure) {
                $qb->andWhere('LOWER(t.pointDepart) LIKE LOWER(:departure)')
                    ->setParameter('departure', '%' . $departure . '%');
            }

            if ($arrival) {
                $qb->andWhere('LOWER(t.pointArrivee) LIKE LOWER(:arrival)')
                    ->setParameter('arrival', '%' . $arrival . '%');
            }

            // Apply time filter
            if ($timeFilter === 'today') {
                $today = new \DateTime();
                $today->setTime(0, 0, 0);
                $tomorrow = clone $today;
                $tomorrow->modify('+1 day');
                
                $qb->andWhere('t.dateDepart >= :today')
                    ->andWhere('t.dateDepart < :tomorrow')
                    ->setParameter('today', $today)
                    ->setParameter('tomorrow', $tomorrow);
            } elseif ($timeFilter === 'tomorrow') {
                $tomorrow = new \DateTime();
                $tomorrow->setTime(0, 0, 0);
                $tomorrow->modify('+1 day');
                $dayAfterTomorrow = clone $tomorrow;
                $dayAfterTomorrow->modify('+1 day');
                
                $qb->andWhere('t.dateDepart >= :tomorrow')
                    ->andWhere('t.dateDepart < :dayAfterTomorrow')
                    ->setParameter('tomorrow', $tomorrow)
                    ->setParameter('dayAfterTomorrow', $dayAfterTomorrow);
            }

            // Apply price range filter
            if ($priceRange) {
                switch ($priceRange) {
                    case 'under_10':
                        $qb->andWhere('t.prix < 10');
                        break;
                    case '10_15':
                        $qb->andWhere('t.prix >= 10 AND t.prix <= 15');
                        break;
                    case 'over_20':
                        $qb->andWhere('t.prix > 20');
                        break;
                }
            }

            // Apply sorting
            switch ($sortBy) {
                case 'price':
                    $qb->orderBy('t.prix', 'ASC');
                    break;
                case 'distance':
                    $qb->orderBy('t.distance', 'ASC');
                    break;
                default: // time
                    $qb->orderBy('t.dateDepart', 'ASC');
                    break;
            }

            // Get paginated results
            $pagination = $this->paginator->paginate(
                $qb,
                $page,
                9 // items per page
            );

            // Get statistics for dashboard
            $stats = $this->getStatistics($trajetRepository);

            // Check if this is an AJAX request
            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->render('shop/_trips_container.html.twig', [
                    'trajets' => $pagination,
                    'vehicleType' => $vehicleType,
                    'timeFilter' => $timeFilter,
                    'priceRange' => $priceRange,
                    'sortBy' => $sortBy,
                ]);
            }

            // Return full page for non-AJAX requests
            return $this->render('shop.html.twig', [
                'trajets' => $pagination,
                'vehicleType' => $vehicleType,
                'timeFilter' => $timeFilter,
                'priceRange' => $priceRange,
                'sortBy' => $sortBy,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            // Log the error
            $this->logger->error('Error in shop index: ' . $e->getMessage());
            
            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return new Response('Error loading trips: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            
            $this->addFlash('error', 'An error occurred while loading trips. Please try again.');
            return $this->redirectToRoute('app_shop');
        }
    }

    private function getTripStatistics(TrajetRepository $trajetRepository): array
    {
        // Get most popular routes with more detailed statistics
        $popularRoutes = $trajetRepository->createQueryBuilder('t')
            ->select('t.pointDepart, t.pointArrivee, COUNT(t.id) as tripCount, AVG(t.distance) as avgDistance')
            ->groupBy('t.pointDepart, t.pointArrivee')
            ->having('tripCount > 0')
            ->orderBy('tripCount', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        // Get vehicle distribution with percentage
        $totalTrips = $trajetRepository->createQueryBuilder('t')
            ->select('COUNT(t.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $vehicleStats = $trajetRepository->createQueryBuilder('t')
            ->select('v.type, COUNT(t.id) as count')
            ->leftJoin('t.vehicule', 'v')
            ->groupBy('v.type')
            ->getQuery()
            ->getResult();

        // Calculate percentages for vehicle stats
        foreach ($vehicleStats as &$stat) {
            $stat['percentage'] = ($stat['count'] / $totalTrips) * 100;
        }

        // Get weather data for major cities
        $weatherData = [];
        $majorCities = ['Tunis', 'Sfax', 'Sousse'];
        foreach ($majorCities as $city) {
            try {
                $weatherData[$city] = $this->weatherService->getWeatherByCity($city);
            } catch (\Exception $e) {
                $weatherData[$city] = ['error' => 'Weather data unavailable'];
            }
        }

        return [
            'popularRoutes' => $popularRoutes,
            'vehicleStats' => $vehicleStats,
            'weatherData' => $weatherData,
            'totalTrips' => $totalTrips
        ];
    }

    private function getStatistics(TrajetRepository $trajetRepository): array
    {
        // Get all statistics
        $stats = $this->getTripStatistics($trajetRepository);

        return [
            'popularRoutes' => $stats['popularRoutes'],
            'vehicleStats' => $stats['vehicleStats'],
            'weatherData' => $stats['weatherData'],
            'totalTrips' => $stats['totalTrips']
        ];
    }
}