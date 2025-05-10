<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Form\TrajetType;
use App\Repository\TrajetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/trajet')]
class TrajetController extends AbstractController
{
    #[Route('/', name: 'trajet_index', methods: ['GET'])]
    public function index(TrajetRepository $trajetRepository): Response
    {
        return $this->render('trajet/index.html.twig', [
            'trajets' => $trajetRepository->findAll(),
        ]);
    }

    #[Route('/search-trips', name: 'search_trips', methods: ['GET'])]
    public function searchTrips(Request $request, TrajetRepository $trajetRepository): JsonResponse
    {
        try {
            $location = $request->query->get('location');
            $date = $request->query->get('date');
            $type = $request->query->get('type', 'to');

            if (!$location || !$date) {
                return new JsonResponse([
                    'error' => 'Location and date are required',
                    'location' => $location,
                    'date' => $date
                ], Response::HTTP_BAD_REQUEST);
            }

            $dateObj = new \DateTime($date);
            
            // Search for trips based on type (to/from event)
            if ($type === 'to') {
                $trips = $trajetRepository->findByPointArriveeAndDate($location, $dateObj);
            } else {
                $trips = $trajetRepository->findByPointDepartAndDate($location, $dateObj);
            }

            $formattedTrips = array_map(function(Trajet $trip) {
                return [
                    'id' => $trip->getId(),
                    'pointDepart' => $trip->getPointDepart(),
                    'pointArrivee' => $trip->getPointArrivee(),
                    'dateDepart' => $trip->getDateDepart()->format('Y-m-d H:i'),
                    'prix' => $trip->getPrix(),
                    'vehicule' => [
                        'capacite' => $trip->getVehicule()->getCapacite(),
                        'type' => $trip->getVehicule()->getType()
                    ]
                ];
            }, $trips);

            return new JsonResponse(['trips' => $formattedTrips]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => 'An error occurred while searching for trips',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/new', name: 'trajet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trajet = new Trajet();
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trajet);
            $entityManager->flush();

            $this->addFlash('success', 'Trip created successfully!');
            return $this->redirectToRoute('trajet_index');
        }

        return $this->render('trajet/new.html.twig', [
            'trajet' => $trajet,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'trajet_show', methods: ['GET'])]
    public function show(Trajet $trajet): Response
    {
        return $this->render('trajet/show.html.twig', [
            'trajet' => $trajet,
        ]);
    }

    #[Route('/{id}/edit', name: 'trajet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trajet $trajet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Trip updated successfully!');
            return $this->redirectToRoute('trajet_index');
        }

        return $this->render('trajet/edit.html.twig', [
            'trajet' => $trajet,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'trajet_delete', methods: ['POST'])]
    public function delete(Request $request, Trajet $trajet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trajet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trajet);
            $entityManager->flush();

            $this->addFlash('success', 'Trip deleted successfully!');
        }

        return $this->redirectToRoute('trajet_index');
    }
} 