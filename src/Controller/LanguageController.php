<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    #[Route('/language/{locale}', name: 'app_language')]
    public function switchLanguage(Request $request, string $locale): Response
    {
        // Check if the locale is supported
        if (!in_array($locale, ['en', 'fr'])) {
            $locale = 'en';
        }

        // Store the locale in the session
        $session = $request->getSession();
        $session->set('_locale', $locale);

        // Set the locale for the current request
        $request->setLocale($locale);

        // Get the referer URL or default to the shop page
        $referer = $request->headers->get('referer');
        if (!$referer) {
            return $this->redirectToRoute('app_shop');
        }

        // Redirect to the previous page
        return $this->redirect($referer);
    }
} 