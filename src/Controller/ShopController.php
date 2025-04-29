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
        // Get filter parameters
        $vehicleType = $request->query->get('vehicle_type');
        $timeFilter = $request->query->get('time', 'all');
        $priceRange = $request->query->get('price_range');
        $sortBy = $request->query->get('sort_by', 'time');
        $page = $request->query->getInt('page', 1);
        $departure = $request->query->get('departure');
        $arrival = $request->query->get('arrival');

        // Create query builder
        $qb = $trajetRepository->createQueryBuilder('t')
            ->leftJoin('t.vehicule', 'v')
            ->orderBy('t.dateDepart', 'ASC');

        // Apply filters
        if ($vehicleType) {
            $qb->andWhere('v.type = :vehicleType')
                ->setParameter('vehicleType', $vehicleType);
        }

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

        if ($departure) {
            $qb->andWhere('t.pointDepart LIKE :departure')
                ->setParameter('departure', '%' . $departure . '%');
        }

        if ($arrival) {
            $qb->andWhere('t.pointArrivee LIKE :arrival')
                ->setParameter('arrival', '%' . $arrival . '%');
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
            // Return only the trips container and pagination
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

    private function getStatistics(TrajetRepository $trajetRepository): array
    {
        // Get statistics for the dashboard
        $stats = $this->getTripStatistics($trajetRepository);

        // Get most frequent vehicle types
        $vehicleStats = $trajetRepository->createQueryBuilder('t')
            ->select('v.type, COUNT(t.id) as count')
            ->leftJoin('t.vehicule', 'v')
            ->groupBy('v.type')
            ->orderBy('count', 'DESC')
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
            'popularRoutes' => $stats['popularRoutes'],
            'bestValueTrips' => $stats['bestValueTrips'],
            'vehicleStats' => $vehicleStats,
            'priceStats' => $stats['priceStats'],
            'weatherData' => $weatherData
        ];
    }
}