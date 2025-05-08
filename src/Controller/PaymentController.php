<?php

namespace App\Controller;

use App\Service\PaymentService;
use App\Entity\Trajet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    private PaymentService $paymentService;
    private EntityManagerInterface $entityManager;

    public function __construct(PaymentService $paymentService, EntityManagerInterface $entityManager)
    {
        $this->paymentService = $paymentService;
        $this->entityManager = $entityManager;
    }

    #[Route('/payment/process', name: 'app_payment_process', methods: ['POST'])]
    public function processPayment(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required data
        if (!isset($data['booking_id']) || !isset($data['trip_details']) || !isset($data['trip_id']) || !isset($data['number_of_seats'])) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Missing required booking information'
            ], 400);
        }

        // Get the trip and update seats
        $trip = $this->entityManager->getRepository(Trajet::class)->find($data['trip_id']);
        if (!$trip) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Trip not found'
            ], 404);
        }

        // Check if enough seats are available
        $vehicule = $trip->getVehicule();
        if ($vehicule->getCapacite() < $data['number_of_seats']) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Not enough seats available'
            ], 400);
        }

        // Process the payment
        $paymentResult = $this->paymentService->processFreePayment($data);

        if (!$paymentResult['success']) {
            return new JsonResponse($paymentResult, 400);
        }

        // Update vehicle capacity
        $vehicule->setCapacite($vehicule->getCapacite() - $data['number_of_seats']);
        $this->entityManager->persist($vehicule);
        $this->entityManager->flush();

        // Generate receipt
        $receipt = $this->paymentService->generatePaymentReceipt([
            'payment_id' => $paymentResult['payment_id'],
            'booking_id' => $data['booking_id'],
            'trip_details' => $data['trip_details'],
            'passenger_name' => $data['passenger_name'] ?? 'Guest'
        ]);

        return new JsonResponse([
            'success' => true,
            'payment' => $paymentResult,
            'receipt' => $receipt,
            'remaining_seats' => $vehicule->getCapacite()
        ]);
    }

    #[Route('/payment/receipt/{paymentId}', name: 'app_payment_receipt', methods: ['GET'])]
    public function getReceipt(string $paymentId): JsonResponse
    {
        // In a real application, you would fetch this from a database
        $receipt = $this->paymentService->generatePaymentReceipt([
            'payment_id' => $paymentId,
            'booking_id' => 'BOOK-' . uniqid(),
            'trip_details' => 'Sample Trip',
            'passenger_name' => 'Guest'
        ]);

        return new JsonResponse($receipt);
    }
} 