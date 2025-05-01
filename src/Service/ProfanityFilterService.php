<?php


// src/Service/ProfanityFilterService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProfanityFilterService
{
    private HttpClientInterface $httpClient;
    
    // Hardcoded API credentials
    private const API_URL = 'https://profanity-filter-by-api-ninjas.p.rapidapi.com/v1/profanityfilter';
    private const API_KEY = '54c18af5b6mshf7f78a660ff45fep1c79e3jsn5327daf7875c'; 
    private const API_HOST = 'profanity-filter-by-api-ninjas.p.rapidapi.com';

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function filterText(string $text): array
    {
        $response = $this->httpClient->request('GET', self::API_URL, [
            'headers' => [
                'X-RapidAPI-Host' => self::API_HOST,
                'X-RapidAPI-Key' => self::API_KEY,
            ],
            'query' => [
                'text' => $text
            ]
        ]);

        return $response->toArray();
    }

    public function containsProfanity(string $text): bool
    {
        try {
            $result = $this->filterText($text);
            return $result['has_profanity'] ?? false;
        } catch (\Exception $e) {
            // Consider adding logger here: $this->logger->error(...)
            return false; // Fail-safe approach
        }
    }
}