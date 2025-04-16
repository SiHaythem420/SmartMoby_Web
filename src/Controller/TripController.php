<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Repository\TrajetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TripController extends AbstractController
{
    #[Route('/front/trip/{id}', name: 'app_trip_details')]
    public function index(Trajet $trip): Response
    {
        return $this->render('trip_details.html.twig', [
            'trip' => $trip,
        ]);
    }
} 