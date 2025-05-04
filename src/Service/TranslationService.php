<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TranslationService
{
    private HttpClientInterface $client;
    private string $apiUrl = 'https://deep-translate1.p.rapidapi.com/language/translate/v2';
    private string $apiKey = 'd55fd3ff79mshbea0c0e66f43cd1p155af5jsn42befdcd833e';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function translate(string $text, string $targetLang = 'en', string $sourceLang = 'fr'): ?string
{
    if (empty($text)) {
        throw new \InvalidArgumentException("Le texte à traduire est vide.");
    }

    $response = $this->client->request('POST', $this->apiUrl, [
        'headers' => [
            'Content-Type' => 'application/json',
            'X-RapidAPI-Key' => $this->apiKey,
            'X-RapidAPI-Host' => 'deep-translate1.p.rapidapi.com',
        ],
        'json' => [
            'q' => $text,
            'source' => $sourceLang,
            'target' => $targetLang,
        ],
    ]);

    $data = $response->toArray(false);
    if (isset($data['data']['translations']['translatedText'][0])) {
        return $data['data']['translations']['translatedText'][0];
    }
    
    

    throw new \RuntimeException("Réponse inattendue de l'API : " . json_encode($data));
}

}
