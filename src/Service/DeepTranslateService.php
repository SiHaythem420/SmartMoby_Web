<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeepTranslateService
{
    private $client;
    private $apiKey;
    private $apiHost;

    public function __construct(HttpClientInterface $client, string $apiKey, string $apiHost)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->apiHost = $apiHost;
    }

    public function translate(string $text, string $targetLang): ?string
    {
        $response = $this->client->request(
            'POST',
            'https://deep-translate1.p.rapidapi.com/language/translate/v2',
            [
                'headers' => [
                    'content-type' => 'application/json',
                    'X-RapidAPI-Key' => $this->apiKey,
                    'X-RapidAPI-Host' => $this->apiHost,
                ],
                'json' => [
                    'q' => $text,
                    'target' => $targetLang,
                ],
            ]
        );

        try {
            $content = $response->toArray();
            return $content['data']['translations']['translatedText'] ?? null;
        } catch (\Exception $e) {
            // Log error or handle it appropriately
            return null;
        }
    }
}