<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Admin;
use App\Entity\Utilisateur;
use App\Entity\Client;
use App\Entity\Conducteur;
use App\Entity\Organisateur;

final class BackController extends AbstractController{
    #[Route('/back', name: 'app_back')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(Utilisateur::class)->findAll();
        $admins = $entityManager->getRepository(Admin::class)->findAll();
        $conducteurs = $entityManager->getRepository(Conducteur::class)->findAll();
        $clients = $entityManager->getRepository(Client::class)->findAll();
        $organisateurs = $entityManager->getRepository(Organisateur::class)->findAll();
        return $this->render('back/index.html.twig', [
            'users' => $users,
            'admins' => $admins,
            'conducteurs' => $conducteurs,
            'clients' => $clients,
            'organisateurs' => $organisateurs,
        ]);
    }
}
