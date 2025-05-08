<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PaymentService
{
    private HttpClientInterface $client;
    private string $mockPaymentApiUrl;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->mockPaymentApiUrl = 'https://run.mocky.io/v3/30b57285-1c8e-4c0b-a5e1-08142bbd7aa2'; // Updated mock payment API URL
    }

    public function processFreePayment(array $bookingData): array
    {
        try {
            // Simulate payment processing
            $response = $this->client->request('POST', $this->mockPaymentApiUrl, [
                'json' => [
                    'booking_id' => $bookingData['booking_id'],
                    'amount' => 0,
                    'currency' => 'TND',
                    'description' => 'Trip Booking - ' . $bookingData['trip_details'],
                    'status' => 'completed'
                ]
            ]);

            $data = json_decode($response->getContent(), true);

            return [
                'success' => true,
                'payment_id' => $data['payment_id'] ?? uniqid('PAY-'),
                'status' => 'completed',
                'message' => 'Payment processed successfully'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Payment processing failed: ' . $e->getMessage()
            ];
        }
    }

    public function generatePaymentReceipt(array $paymentData): array
    {
        return [
            'receipt_id' => uniqid('REC-'),
            'payment_id' => $paymentData['payment_id'],
            'amount' => 0,
            'currency' => 'TND',
            'date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'details' => [
                'trip' => $paymentData['trip_details'],
                'passenger' => $paymentData['passenger_name'],
                'booking_reference' => $paymentData['booking_id']
            ]
        ];
    }
} 