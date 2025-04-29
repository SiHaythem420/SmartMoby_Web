<?php

namespace App\Controller;

use App\Service\PaymentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    #[Route('/payment/process', name: 'app_payment_process', methods: ['POST'])]
    public function processPayment(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required data
        if (!isset($data['booking_id']) || !isset($data['trip_details'])) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Missing required booking information'
            ], 400);
        }

        // Process the payment
        $paymentResult = $this->paymentService->processFreePayment($data);

        if (!$paymentResult['success']) {
            return new JsonResponse($paymentResult, 400);
        }

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
            'receipt' => $receipt
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