<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\TranslationService;
#[Route('/service')]
final class ServiceController extends AbstractController
{
    #[Route('/', name: 'app_service_index', methods: ['GET'])]
    public function index(Request $request, ServiceRepository $repo): Response
    {
        // récupère le paramètre 'search' (ou chaîne vide)
        $term = $request->query->get('search', '');

        // filtre ou non
        $services = $term !== ''
            ? $repo->findByTerm($term)
            : $repo->findAll();

        return $this->render('service/index.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/new', name: 'app_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('service/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id_service}', name: 'app_service_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{id_service}/edit', name: 'app_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('service/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }
    
    #[Route('/translate', name: 'service_translate', methods: ['POST'])]
    public function translateDescription(
        Request $request,
        TranslationService $translator
    ): JsonResponse {
        try {
            $data = json_decode($request->getContent(), true);
    
            if (!isset($data['text'], $data['sourceLang'], $data['targetLang'])) {
                return new JsonResponse(['error' => 'Paramètres manquants'], 400);
            }
    
            $translatedText = $translator->translate(
                $data['text'],
                $data['targetLang'],
                $data['sourceLang']
            );
    
            return new JsonResponse(['translated' => $translatedText]);
        } catch (\Throwable $e) {
            return new JsonResponse([
                'error' => 'Erreur serveur : ' . $e->getMessage(),
            ], 500);
        }
    }
    



    #[Route('/{id_service}', name: 'app_service_delete', methods: ['POST'])]
    public function delete(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId_service(), $request->request->get('_token'))) {
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
    }
   
   

}