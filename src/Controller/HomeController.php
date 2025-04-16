<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Entity\Vehicule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrajetRepository;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, TrajetRepository $trajetRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $trajets = $trajetRepository->findBy(
            [], // No specific criteria
            ['dateDepart' => 'ASC'], // Order by departure date
            null // Get all results for pagination
        );
        
        return $this->render('base.html.twig', [
            'trajets' => $trajets,
            'page' => $page
        ]);
    }

    #[Route('/maps', name: 'app_google_maps')]
    public function maps(): Response
    {
        return $this->render('maps/index.html.twig');
    }

    #[Route('/trips', name: 'app_trips')]
    public function trips(TrajetRepository $trajetRepository): Response
    {
        $trajets = $trajetRepository->findBy([], ['dateDepart' => 'ASC']);

        return $this->render('home/trips.html.twig', [
            'trajets' => $trajets,
        ]);
    }

    #[Route('/shop', name: 'app_shop')]
    public function shop(Request $request, TrajetRepository $trajetRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $trajets = $trajetRepository->findBy(
            [], 
            ['dateDepart' => 'ASC'],
            null
        );
        
        return $this->render('shop.html.twig', [
            'trajets' => $trajets,
            'currentPage' => $page
        ]);
    }
} 