<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Repository\TrajetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    #[Route('/front/book/{id}', name: 'app_book_trip')]
    public function bookTrip(Trajet $trip, EntityManagerInterface $entityManager): Response
    {
        // Check if there are available seats
        if ($trip->getVehicule()->getCapacite() <= 0) {
            $this->addFlash('error', 'No seats available for this trip.');
            return $this->redirectToRoute('app_trip_details', ['id' => $trip->getId()]);
        }

        // Decrease capacity by 1
        $vehicule = $trip->getVehicule();
        $vehicule->setCapacite($vehicule->getCapacite() - 1);

        // Update the vehicle in the database
        $entityManager->persist($vehicule);
        $entityManager->flush();

        $this->addFlash('success', 'Trip booked successfully!');
        return $this->redirectToRoute('app_trip_details', ['id' => $trip->getId()]);
    }
} 