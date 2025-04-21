<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    private WeatherService $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    #[Route('/weather/search', name: 'app_weather_search')]
    public function search(Request $request): JsonResponse
    {
        $city = $request->query->get('city');

        if (!$city) {
            return new JsonResponse(['error' => 'City name is required'], 400);
        }

        try {
            $weatherData = $this->weatherService->getWeatherByCity($city);
            return new JsonResponse($weatherData);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to fetch weather data: ' . $e->getMessage()], 500);
        }
    }
} 