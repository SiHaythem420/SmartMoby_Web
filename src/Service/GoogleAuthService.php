<?php
namespace App\Service;

use Google_Client;
use Google_Service_Calendar;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Google_Service_Calendar_Event;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GoogleAuthService
{
    private $client;
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        // Charge le fichier credentials.json à partir du chemin où il a été placé
        $this->client = new Google_Client();
        $authData = json_decode(file_get_contents(__DIR__ . '/../../config/google/credentials.json'), true);
        $this->client->setClientId($authData['web']['client_id']);
        $this->client->setClientSecret($authData['web']['client_secret']);
        $this->client->setRedirectUri($authData['web']['redirect_uris'][0]);
        $this->client->setScopes([Google_Service_Calendar::CALENDAR_EVENTS]);
        $this->client->setRedirectUri('http://127.0.0.1:8000/oauth/callback');
        $this->requestStack = $requestStack;
    }

    /**
     * Génère l'URL d'autorisation Google OAuth.
     *
     * @return string
     */
    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    /**
     * Récupère le token d'accès après la validation du code d'autorisation.
     *
     * @param Request $request
     * @return array|null
     */
    public function fetchAccessToken(Request $request): ?array
    {
        $code = $request->get('code');
        if ($code) {
            // Récupère le token d'accès en utilisant le code d'autorisation
            $accessToken = $this->client->fetchAccessTokenWithAuthCode($code);

            // Sauvegarde du refresh_token dans la session si disponible
            if (isset($accessToken['refresh_token'])) {
                $this->requestStack->getCurrentRequest()->getSession()->set('google_refresh_token', $accessToken['refresh_token']);
            }

            // Sauvegarde du token d'accès dans la session
            $this->requestStack->getCurrentRequest()->getSession()->set('google_access_token', $accessToken);

            return $accessToken;
        }
        return null;
    }

    /**
     * Récupère le client Google configuré avec le token d'accès valide.
     *
     * @return Google_Client
     */
    public function getClient()
{
    // Vérifie si un token d'accès existe dans la session
    if ($this->requestStack->getCurrentRequest()->getSession()->has('google_access_token')) {
        $accessToken = $this->requestStack->getCurrentRequest()->getSession()->get('google_access_token');
        $this->client->setAccessToken($accessToken);

        // Si le token d'accès a expiré, rafraîchissez-le
        if ($this->client->isAccessTokenExpired()) {
            // Vérifier si un refresh_token est disponible
            if (isset($accessToken['refresh_token'])) {
                $refreshToken = $accessToken['refresh_token'];
                $newAccessToken = $this->client->fetchAccessTokenWithRefreshToken($refreshToken);

                // Sauvegarde le nouveau token dans la session
                $this->requestStack->getCurrentRequest()->getSession()->set('google_access_token', $newAccessToken);
            } else {
                // Si aucun refresh_token n'est disponible, demande une nouvelle autorisation
                $this->clearSessionTokens();
                return $this->client->createAuthUrl(); // Retourne l'URL d'autorisation
            }
        }
    }

    return $this->client;
}


    /**
     * Crée un événement dans Google Calendar.
     *
     * @param array $eventDetails
     * @return \Google_Service_Calendar_Event|null
     */
    public function createEvent(array $eventDetails)
    {
        try {
            $client = $this->getClient();

            // Utilisation complète du nom de la classe sans importation
            $service = new \Google_Service_Calendar($client);

            $event = new \Google_Service_Calendar_Event([
                'summary' => $eventDetails['summary'],
                'start' => [
                    'date' => $eventDetails['start_date'],
                    'timeZone' => 'Europe/Paris',
                ],
                'end' => [
                    'date' => $eventDetails['end_date'],
                    'timeZone' => 'Europe/Paris',
                ],
                'location' => $eventDetails['location'],
                'attendees' => $eventDetails['attendees'], // Liste des invités (si nécessaire)
            ]);

            $calendarId = 'primary'; // Utiliser 'primary' pour le calendrier principal
            return $service->events->insert($calendarId, $event);
        } catch (\Exception $e) {
            // Gestion des erreurs
            $this->addFlash('error', 'Erreur lors de la création de l\'événement : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Supprime les tokens de la session.
     */
    private function clearSessionTokens()
    {
        $this->requestStack->getCurrentRequest()->getSession()->remove('google_access_token');
        $this->requestStack->getCurrentRequest()->getSession()->remove('google_refresh_token');
    }
}
