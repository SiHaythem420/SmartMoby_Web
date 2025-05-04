<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nucleos\DompdfBundle\Wrapper\DompdfWrapperInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twilio\Rest\Client;
#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'produit_index', methods: ['GET'])]
    public function index(Request $request, ProduitRepository $repo): Response
    {
        $term = $request->query->get('search', '');
        $produits = $term !== ''
            ? $repo->findByTerm($term)
            : $repo->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/new', name: 'produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'produit_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'produit_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form'    => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'produit_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $produit->getIdproduit(), $request->request->get('_token'))) {
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('produit_index');
    }

    #[Route('/export/pdf', name: 'produit_pdf', methods: ['GET'])]
    public function exportPdf(
        Request $request,
        ProduitRepository $repo,
        DompdfWrapperInterface $wrapper
    ): Response {
        $term = $request->query->get('search', '');
        $produits = $term !== ''
            ? $repo->findByTerm($term)
            : $repo->findAll();

        $html = $this->renderView('produit/pdf.html.twig', [
            'produits' => $produits,
        ]);

        return $wrapper->getStreamResponse($html, 'liste_produits.pdf');
    }

    // src/Controller/ProduitController.php
// … vos use …


private function callGemini(HttpClientInterface $client, string $apiKey, string $model, string $prompt): string
{
    $url = sprintf(
        'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent?key=%s',
        $model,
        $apiKey
    );

    $payload = [
        'contents' => [
            ['parts' => [['text' => $prompt]]]
        ],
    ];

    $resp = $client->request('POST', $url, ['json' => $payload]);
    $data = $resp->toArray(false);

    return $data['candidates'][0]['content']['parts'][0]['text']
         ?? '(réponse introuvable)';
}

#[Route('/produit/chatbot', name: 'produit_chatbot', methods: ['GET','POST'])]
public function chatbot(
    Request $request,
    HttpClientInterface $client,
    ProduitRepository $repo
): Response {
    // 1️⃣ Votre clé et modèle Gemini
    $apiKey = 'AIzaSyAVIj0z5bkr-qxMU4sFGCBbcs4CbnflgYw';
    $model  = 'gemini-1.5-flash';

    $userMessage   = $request->request->get('message', '');
    $botResponse   = null;
    $error         = null;

    // 2️⃣ Construisons la description des produits
    $produits = $repo->findAll();
    $lines = [];
    foreach ($produits as $p) {
        $lines[] = sprintf(
            '- %s (%s) à %0.2f €',
            $p->getNom(),
            $p->getType(),
            $p->getPrix()
        );
    }
    $listeProduits = implode("\n", $lines);

    try {
        if ($request->isMethod('GET')) {
            // Premier message : pitch commercial
            $prompt = <<<TXT
Bienvenue ! Voici nos produits disponibles :
{$listeProduits}

Fais-moi un petit texte commercial chaleureux en français, en mentionnant ces produits et leurs atouts.
TXT;
            $botResponse = $this->callGemini($client, $apiKey, $model, $prompt);
        }
        elseif ($request->isMethod('POST') && trim($userMessage) !== '') {
            // Réponse aux questions utilisateur
            $prompt = <<<TXT
Voici la liste de nos produits :
{$listeProduits}

Question du client : "{$userMessage}"
Réponds en français clair et précis.
TXT;
            $botResponse = $this->callGemini($client, $apiKey, $model, $prompt);
        }
    } catch (\Exception $e) {
        $error = 'Erreur API : ' . $e->getMessage();
    }

    return $this->render('produit/chatbot.html.twig', [
        'message'  => $userMessage,
        'response' => $botResponse,
        'error'    => $error,
    ]);
}
#[Route('/produit/{id}/panier/ajouter', name:'produit_add_to_cart')]
public function addToCart(int $id, SessionInterface $session, ProduitRepository $repo): Response
{
    $produit = $repo->find($id);
    if (!$produit) {
        throw $this->createNotFoundException('Produit introuvable');
    }
    $cart = $session->get('cart', []);
    if (!in_array($id, $cart)) {
        $cart[] = $id;
        $session->set('cart', $cart);
        $this->addFlash('success','Produit ajouté au panier');
    }
    return $this->redirectToRoute('produit_index');
}

#[Route('/produit/panier', name:'produit_cart', methods:['GET','POST'])]
public function cart(
    Request $request,
    SessionInterface $session,
    ProduitRepository $repo,
    ParameterBagInterface $params
): Response {
    // 1) récupère le contenu du panier
    $ids      = $session->get('cart', []);
    $produits = $ids
        ? $repo->findBy(['idproduit' => $ids])
        : [];

    // 2) si POST, on envoie le SMS
    if ($request->isMethod('POST') && count($produits) > 0) {
        // 2.1) paramètres Twilio
        $sid       = $params->get('twilio.sid');
        $token     = $params->get('twilio.auth_token');
        $from      = $params->get('twilio.from');
        $adminPhone= $params->get('twilio.admin_phone');

        // 2.2) corps du SMS
        $body = sprintf(
            "Nouvelle commande : %d produit(s) dans le panier.",
            count($produits)
        );

        // 2.3) envoi
        try {
            $twilio = new Client($sid, $token);
            $message = $twilio->messages->create(
                $adminPhone,
                [
                    'from' => $from,
                    'body' => $body,
                ]
            );
            // on récupère l’ID du message envoyé
            $this->addFlash('success', 'SMS envoyé (SID : '.$message->sid.')');
            // vide le panier
            $session->remove('cart');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Échec envoi SMS : '.$e->getMessage());
        }

        return $this->redirectToRoute('produit_cart');
    }

    // 3) affichage du panier
    return $this->render('produit/cart.html.twig', [
        'produits' => $produits,
    ]);
}


}
