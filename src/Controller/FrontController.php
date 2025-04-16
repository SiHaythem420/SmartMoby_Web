<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AdminType;
use App\Entity\Admin;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\TrajetRepository;
use App\Entity\Trajet;

final class FrontController extends AbstractController
{
    #[Route('/front', name: 'app_front')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $trajets = $entityManager->getRepository(Trajet::class)->findAll();
        return $this->render('front/index.html.twig', [
            'controller_name' => 'app_controller',
            'trajets' => $trajets,
        ]);
    }

    
    


}
