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

class ShopController extends AbstractController
{
    private GoogleMapsService $googleMapsService;
    private WeatherService $weatherService;

    public function __construct(GoogleMapsService $googleMapsService, WeatherService $weatherService)
    {
        $this->googleMapsService = $googleMapsService;
        $this->weatherService = $weatherService;
    }

    
    #[Route('/front/shop', name: 'app_shop')]
    public function index(
        Request $request,
        TrajetRepository $trajetRepository,
        PaginatorInterface $paginator,
        EntityManagerInterface $entityManager
    ): Response {
        // Get filter parameters from request
        $vehicleType = $request->query->get('vehicle_type');
        $timeFilter = $request->query->get('time', 'all');
        $priceRange = $request->query->get('price_range');
        $sortBy = $request->query->get('sort_by', 'time');
        
        // Build query based on filters
        $queryBuilder = $trajetRepository->createQueryBuilder('t')
            ->leftJoin('t.vehicule', 'v');
            
        // Apply vehicle type filter
        if ($vehicleType) {
            $queryBuilder->andWhere('v.type = :vehicleType')
                ->setParameter('vehicleType', $vehicleType);
        }
        
        // Apply time filter
        if ($timeFilter === 'today') {
            $today = new \DateTime();
            $today->setTime(0, 0, 0);
            $tomorrow = clone $today;
            $tomorrow->modify('+1 day');
            
            $queryBuilder->andWhere('t.dateDepart >= :today AND t.dateDepart < :tomorrow')
                ->setParameter('today', $today)
                ->setParameter('tomorrow', $tomorrow);
        } elseif ($timeFilter === 'tomorrow') {
            $tomorrow = new \DateTime();
            $tomorrow->setTime(0, 0, 0);
            $tomorrow->modify('+1 day');
            $dayAfterTomorrow = clone $tomorrow;
            $dayAfterTomorrow->modify('+1 day');
            
            $queryBuilder->andWhere('t.dateDepart >= :tomorrow AND t.dateDepart < :dayAfterTomorrow')
                ->setParameter('tomorrow', $tomorrow)
                ->setParameter('dayAfterTomorrow', $dayAfterTomorrow);
        }
        
        // Apply price range filter
        if ($priceRange) {
            switch ($priceRange) {
                case 'under_10':
                    $queryBuilder->andWhere('t.prix < 10');
                    break;
                case '10_15':
                    $queryBuilder->andWhere('t.prix >= 10 AND t.prix <= 15');
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
        
        $query = $queryBuilder->getQuery();
        
        $trajets = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            9 // Items per page
        );
        
        // Get statistics for the dashboard
        $stats = $this->getTripStatistics($trajetRepository);

        return $this->render('shop.html.twig', [
            'trajets' => $trajets,
            'vehicleType' => $vehicleType,
            'timeFilter' => $timeFilter,
            'priceRange' => $priceRange,
            'sortBy' => $sortBy,
            'stats' => $stats
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
            'bestValueTrips' => $bestValueTrips,
            'vehicleStats' => $vehicleStats,
            'priceStats' => $priceStats,
            'weatherData' => $weatherData
        ];
    }
}