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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Form\UtilisateurType;
use App\Form\AdminType;
use App\Form\UtilisateurBackType;
use App\Form\UpdateUtilisateurType;


final class BackController extends AbstractController{
    #[Route('/back', name: 'app_back')]
    public function index(EntityManagerInterface $entityManager , SessionInterface $session): Response
    {
        if (!$session->get('user_id')) {
            // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
            return $this->redirectToRoute('app_back_login');
        }

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

    #[Route('/back/login', name: 'app_back_login')]
    public function login( Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $error = null;
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $motDePasse = $request->request->get('mot_de_passe');
            dump($email);
            dump($motDePasse);
    
            $utilisateur = $entityManager->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);
    
            if ($utilisateur &&  $utilisateur->getRole() === 'admin' && password_verify($motDePasse, $utilisateur->getMotDePasse())) {
                $session->set('user_id', $utilisateur->getId());
                return $this->redirectToRoute('app_back');
            } else {
                $error = 'Email ou mot de passe invalide, ou vous n\'êtes pas un administrateur.';
            }
        }
        return $this->render('back/login.html.twig' , [
            'error' => $error,
        ]);
    }

    #[Route('/back/inscription', name: 'app_back_inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurBackType::class, $utilisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
                $utilisateur = $form->getData();
                $utilisateur->setRole('admin');
                $request->getSession()->set('utilisateur_data', $utilisateur); 
                return $this->redirectToRoute('app_back_inscription_admin');
            
        } 
            
        return $this->render('back/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/back/inscription/admin', name: 'app_back_inscription_admin')]
    public function inscriptionAdmin(Request $request, EntityManagerInterface $entityManager, SessionInterface $session , UserPasswordHasherInterface $passwordHasher): Response
    {
        $session = $request->getSession();
        $utilisateurData = $session->get('utilisateur_data');

        if (!$utilisateurData) {
            return $this->redirectToRoute('app_back_inscription');
        }

        $utilisateur = new Utilisateur();
        $utilisateur->setNom($utilisateurData->getNom());
        $utilisateur->setPrenom($utilisateurData->getPrenom());
        $utilisateur->setNomUtilisateur($utilisateurData->getNomUtilisateur());
        $utilisateur->setEmail($utilisateurData->getEmail());
        $hashedPassword = $passwordHasher->hashPassword($utilisateur, $utilisateurData->getMotDePasse());
        $utilisateur->setMotDePasse($hashedPassword);
        $utilisateur->setRole('admin');

        $admin = new Admin();
        $utilisateur->addAdmin($admin);

        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($utilisateur);
            $entityManager->persist($admin);
            $entityManager->flush();

            $session->remove('utilisateur_data');
            $session->set('user_id', $utilisateur->getId());

            return $this->redirectToRoute('app_back');
        }

        return $this->render('back/inscription_admin_back.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/back/logout', name: 'back_logout')]
    public function logout(SessionInterface $session)
    {
        $session->clear();
        return $this->redirectToRoute('app_back_login');
    }

    #[Route('/back/account_settings', name: 'app_back_account_settings')] // Correction du slash manquant
    public function parametres_back(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $userId = $session->get('user_id');

        if (!$userId) {
            return $this->redirectToRoute('app_back_login');
        }

        $user = $entityManager->getRepository(Utilisateur::class)->find($userId);
        
        if (!$user) {
            return $this->redirectToRoute('app_back_login');
        }

        $user_password = $user->getMotDePasse();
        $form = $this->createForm(UpdateUtilisateurType::class, $user);
        $form->handleRequest($request);

        $currentPassword = $request->request->get('inputPasswordCurrent');

        $form2 = null;
        $admin = $entityManager->getRepository(Admin::class)->find($userId);
        if ($admin) {
            $form2 = $this->createForm(AdminType::class, $admin);
            $form2->handleRequest($request);
        }

        if ($request->isMethod('POST')) {
            if ($request->request->has('delete')) {
                if ($admin) {
                    $user->removeAdmin($admin);
                    $entityManager->remove($admin);
                }
                $entityManager->remove($user);
                $entityManager->flush();
                return $this->redirectToRoute('app_back_login');
            } 
        
            if ($request->request->has('update')) {
                if ($form->isSubmitted() && $form->isValid()) {
                    $newPassword = $form->get('mot_de_passe')->getData();
                    if ($newPassword) {
                        $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                        $user->setMotDePasse($hashedPassword);
                    }
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $this->redirectToRoute('app_back');
                }
            } 
        
            if ($request->request->has('update_admin')) {
                if ($form2 && $form2->isSubmitted() && $form2->isValid()) {
                    $entityManager->persist($admin);
                    $entityManager->flush();
                    return $this->redirectToRoute('app_back');
                }
            }
        }

        return $this->render('back/back_account_settings.html.twig', [
            'form' => $form->createView(),
            'form2' => $form2 ? $form2->createView() : null,
        ]);
    }

    }


