<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use App\Repository\AdminRepository;
use App\Repository\OrganisateurRepository;
use App\Repository\ConducteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/search-users', name: 'api_search_users')]
    public function searchUsers(
        Request $request, 
        UtilisateurRepository $utilisateurRepository
    ): JsonResponse
    {
        $searchTerm = $request->query->get('term');
        $users = $utilisateurRepository->searchUsers($searchTerm);
        
        $results = array_map(function($user) {
            $userData = [
                'id' => $user->getId(),
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'nomUtilisateur' => $user->getNomUtilisateur(),
                'email' => $user->getEmail(),
                'motDePasse' => $user->getMotDePasse(),
                'role' => $user->getRole(),
                'ban' => $user->getBan(),
                'departement' => null,
                'numBadge' => null,
                'numeroPermis' => null
            ];

            // Récupérer les informations spécifiques selon le rôle
            switch($user->getRole()) {
                case 'ADMIN':
                    if ($admin = $user->getAdmins()->first()) {
                        $userData['departement'] = $admin->getDepartement();
                    }
                    break;
                
                case 'ORGANISATEUR':
                    if ($organisateur = $user->getOrganisateurs()->first()) {
                        $userData['numBadge'] = $organisateur->getNumBadge();
                    }
                    break;
                
                case 'CONDUCTEUR':
                    if ($conducteur = $user->getConducteurs()->first()) {
                        $userData['numeroPermis'] = $conducteur->getNumeroPermis();
                    }
                    break;
            }

            return $userData;
        }, $users);

        return new JsonResponse($results);
    }
}

