<?php

// src/Service/TranslationService.php


namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TranslationService
{
    private $client;
    private $apiKey;
    private $apiHost;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->apiKey = '54c18af5b6mshf7f78a660ff45fep1c79e3jsn5327daf7875c'; // Replace with your real key
        $this->apiHost = 'deep-translate1.p.rapidapi.com'; // Usually looks like this
    }

    public function translate(string $text, string $sourceLang, string $targetLang): ?string
{
    $response = $this->client->request('POST', 'https://deep-translate1.p.rapidapi.com/language/translate/v2', [
        'headers' => [
            'X-RapidAPI-Key' => $this->apiKey,
            'X-RapidAPI-Host' => $this->apiHost,
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'q' => $text,
            'source' => $sourceLang,
            'target' => $targetLang,
        ],
    ]);

    $data = $response->toArray(false);

    if (isset($data['data']['translations']['translatedText']) && is_array($data['data']['translations']['translatedText'])) {
        return $data['data']['translations']['translatedText'][0] ?? null;
    }
    

    return null;
}



}
