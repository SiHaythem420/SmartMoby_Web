<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class InfobipSmsSender
{
    private HttpClientInterface $httpClient;
    private string $apiUrl;
    private string $apiKey;
    private string $sender;
    private string $template;
    private string $language;

    public function __construct(
        HttpClientInterface $httpClient,
        string $apiUrl,
        string $apiKey,
        string $sender,
        string $template,
        string $language
    ) {
        $this->httpClient = $httpClient;
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->sender = $sender;
        $this->template = $template;
        $this->language = $language;
    }

    public function sendWhatsAppMessage(string $phoneNumber, string $eventTitle): bool
{
    $payload = [
        'messages' => [
            [
                'from' => '447860099299',
                'to' => $phoneNumber,
                'messageId' => uniqid(),
                'content' => [
                    'templateName' => 'test_whatsapp_template_en',
                    'templateData' => [
                        'body' => [
                            'placeholders' => [$eventTitle]
                        ]
                    ],
                    'language' => 'en'
                ]
            ]
        ]
    ];

    try {
        $response = $this->httpClient->request('POST', 'https://qd9ymm.api.infobip.com/whatsapp/1/message/template', [
            'headers' => [
                'Authorization' => 'App c2ce853b8c6ccc5db324ba8275756db6-f2d9ddaf-a2c0-46d6-8691-bcd2d4cdfdb3',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $payload,
        ]);

        $result = $response->toArray(false); // Ne lève pas d’exception
        dump($result); // Affiche le contenu de la réponse

        return $response->getStatusCode() === 200;
    } catch (\Exception $e) {
        dump($e->getMessage());
        return false;
    }
}

}