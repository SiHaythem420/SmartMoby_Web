<?php

// src/Service/TextToSpeechService.php

namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class TextToSpeechService
{
    private HttpClientInterface $client;
    private string $apiKey = '54c18af5b6mshf7f78a660ff45fep1c79e3jsn5327daf7875c';
    private string $apiHost = 'text-to-speach-api.p.rapidapi.com';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAudioContent(string $text): string
    {
        // Clean and prepare the text
        $text = strip_tags($text);
        $text = html_entity_decode($text);
        $text = substr($text, 0, 5000); // Respect API limits

        try {
            $response = $this->client->request(
                'POST',
                'https://' . $this->apiHost . '/text-to-speech',
                [
                    'headers' => [
                        'X-RapidAPI-Host' => $this->apiHost,
                        'X-RapidAPI-Key' => $this->apiKey,
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'text' => $text,  // ACTUAL content goes here
                        'lang' => 'en',
                        'speed' => 'medium' // slow/medium/fast
                    ],
                    'timeout' => 30
                ]
            );

            $content = $response->getContent();

            // Check for errors in response
            if (empty($content) || str_starts_with($content, 'ERROR')) {
                throw new \Exception('API Error: ' . substr($content, 0, 100));
            }

            return $content;

        } catch (\Exception $e) {
            throw new \Exception('TTS Error: ' . $e->getMessage());
        }
    }
}