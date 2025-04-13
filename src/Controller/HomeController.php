<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Entity\Vehicule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $vehicules = $entityManager->getRepository(Vehicule::class)->findAll();
        $trajets = $entityManager->getRepository(Trajet::class)->findAll();
        $available_vehicles = $entityManager->getRepository(Vehicule::class)->findBy(['dispo' => true]);

        return $this->render('home/index.html.twig', [
            'vehicules' => $vehicules,
            'trajets' => $trajets,
            'available_vehicles' => $available_vehicles,
        ]);
    }

    #[Route('/maps', name: 'app_google_maps')]
    public function maps(): Response
    {
        return $this->render('maps/index.html.twig');
    }
} 