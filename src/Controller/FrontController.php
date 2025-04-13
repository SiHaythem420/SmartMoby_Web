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
use App\Entity\Conducteur;
use App\Entity\Organisateur;
use App\Form\ConducteurType;
use App\Form\OrganisateurType;
use App\Form\UpdateMdpUtilisateurType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Form\UpdateUtilisateurType;
use App\Entity\Client;
final class FrontController extends AbstractController
{
    #[Route('/front', name: 'app_controller')]
    public function index(SessionInterface $session): Response
    {
        if (!$session->get('user_id')) {
            // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
            return $this->redirectToRoute('app_inscription');
        }
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/front/login', name: 'app_inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $error=null;
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $form->get('role')->getData();
            if ($role === 'admin') {
                $utilisateur = $form->getData();
                $request->getSession()->set('utilisateur_data', $utilisateur);

                return $this->redirectToRoute('inscription_admin');
            
            } if ($role === 'organisateur') {
                $utilisateur = $form->getData();
                $request->getSession()->set('utilisateur_data', $utilisateur);

                return $this->redirectToRoute('inscription_organisateur');
            
            } if ($role === 'conducteur') {
                $utilisateur = $form->getData();
                $request->getSession()->set('utilisateur_data', $utilisateur);

                return $this->redirectToRoute('inscription_conducteur');
            
            } if ($role === 'client'){
                $utilisateur = $form->getData();
                $request->getSession()->set('utilisateur_data', $utilisateur);

                return $this->redirectToRoute('inscription_client');

            }
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_controller'); // Redirige après l'inscription
        }

        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $motDePasse = $request->request->get('mot_de_passe');
    
            $utilisateur = $entityManager->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);
    
            if ($utilisateur && password_verify($motDePasse, $utilisateur->getMotDePasse())) {
                $session->set('user_id', $utilisateur->getId());
                return $this->redirectToRoute('app_controller');
            } else {
                $error = 'Email ou mot de passe invalide';
            }
        }

        return $this->render('front/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

    #[Route('/front/inscription_admin', name: 'inscription_admin')]
    public function inscriptionAdmin(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $session = $request->getSession();
        $utilisateurData = $session->get('utilisateur_data');

        if (!$utilisateurData) {
            return $this->redirectToRoute('app_inscription');
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

            return $this->redirectToRoute('app_controller');
        }

        return $this->render('front/inscription_admin.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/front/inscription_organisateur', name: 'inscription_organisateur')]
    public function inscriptionOrganisateur(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $session = $request->getSession();
        $utilisateurData = $session->get('utilisateur_data');

        if (!$utilisateurData) {
            return $this->redirectToRoute('app_inscription');
        }

        $utilisateur = new Utilisateur();
        $utilisateur->setNom($utilisateurData->getNom());
        $utilisateur->setPrenom($utilisateurData->getPrenom());
        $utilisateur->setNomUtilisateur($utilisateurData->getNomUtilisateur());
        $utilisateur->setEmail($utilisateurData->getEmail());
        $hashedPassword = $passwordHasher->hashPassword($utilisateur, $utilisateurData->getMotDePasse());
        $utilisateur->setMotDePasse($hashedPassword);
        $utilisateur->setRole('organisateur');

        $organisateur = new Organisateur();
        $utilisateur->addOrganisateur($organisateur);

        $form = $this->createForm(OrganisateurType::class, $organisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($utilisateur);
            $entityManager->persist($organisateur);
            $entityManager->flush();

            $session->remove('utilisateur_data');
            $session->set('user_id', $utilisateur->getId());

            return $this->redirectToRoute('app_controller');
        }

        return $this->render('front/inscription_organisateur.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/front/inscription_conducteur', name: 'inscription_conducteur')]
    public function inscriptionConducteur(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $session = $request->getSession();
        $utilisateurData = $session->get('utilisateur_data');

        if (!$utilisateurData) {
            return $this->redirectToRoute('app_inscription');
        }

        $utilisateur = new Utilisateur();
        $utilisateur->setNom($utilisateurData->getNom());
        $utilisateur->setPrenom($utilisateurData->getPrenom());
        $utilisateur->setNomUtilisateur($utilisateurData->getNomUtilisateur());
        $utilisateur->setEmail($utilisateurData->getEmail());
        $hashedPassword = $passwordHasher->hashPassword($utilisateur, $utilisateurData->getMotDePasse());
        $utilisateur->setMotDePasse($hashedPassword);
        $utilisateur->setRole('conducteur');

        $conducteur = new Conducteur();
        $utilisateur->addConducteur($conducteur);

        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($utilisateur);
            $entityManager->persist($conducteur);
            $entityManager->flush();

            $session->remove('utilisateur_data');
            $session->set('user_id', $utilisateur->getId());

            return $this->redirectToRoute('app_controller');
        }

        return $this->render('front/inscription_conducteur.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/front/inscription_client', name: 'inscription_client')]
    public function inscriptionClient(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $session = $request->getSession();
        $utilisateurData = $session->get('utilisateur_data');

        if (!$utilisateurData) {
            return $this->redirectToRoute('app_inscription');
        }

        $utilisateur = new Utilisateur();
        $utilisateur->setNom($utilisateurData->getNom());
        $utilisateur->setPrenom($utilisateurData->getPrenom());
        $utilisateur->setNomUtilisateur($utilisateurData->getNomUtilisateur());
        $utilisateur->setEmail($utilisateurData->getEmail());
        $hashedPassword = $passwordHasher->hashPassword($utilisateur, $utilisateurData->getMotDePasse());
        $utilisateur->setMotDePasse($hashedPassword);
        $utilisateur->setRole('client');

        $client = new Client();
        $utilisateur->addClient($client);
        $entityManager->persist($utilisateur);
        $entityManager->persist($client);
        $entityManager->flush();

        $session->remove('utilisateur_data');
        $session->set('user_id', $utilisateur->getId());

        return $this->redirectToRoute('app_controller');


    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(SessionInterface $session)
    {
        $session->clear();
        return $this->redirectToRoute('app_inscription');
    }

    #[Route('front/account_settings', name: 'app_account_settings')]
    public function parametres(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $userId = $session->get('user_id');
        dump($userId);


        if (!$userId) {
        return $this->redirectToRoute('app_inscription');
        }

        $user = $entityManager->getRepository(Utilisateur::class)->find($userId);
        dump($user);
        $user_password = $user->getMotDePasse();
        
        $form = $this->createForm(UpdateUtilisateurType::class, $user);
        $form->handleRequest($request);

        $currentPassword = $request->request->get('inputPasswordCurrent');
        dump($currentPassword);

        if (!$user) {
            return $this->redirectToRoute('app_inscription');
        }

        $form2 = null;
        $form3 = null;
        $form4 = null;
        $admin = $entityManager->getRepository(Admin::class)->find($userId);
        $organisateur = $entityManager->getRepository(Organisateur::class)->find($userId);
        $conducteur = $entityManager->getRepository(Conducteur::class)->find($userId);
        $client = $entityManager->getRepository(Client::class)->find($userId);
        if ($admin) {
            dump($admin);
            $form2 = $this->createForm(AdminType::class, $admin);
            $form2->handleRequest($request);
        } else {
            dump('Aucun admin trouvé avec cet ID.');
        }

        if ($organisateur) {
            $form3 = $this->createForm(OrganisateurType::class, $organisateur);
            $form3->handleRequest($request);
        } else {
            dump('Aucun admin trouvé avec cet ID.');
        }

        if ($conducteur) {
            $form4 = $this->createForm(ConducteurType::class, $conducteur);
            $form4->handleRequest($request);
        } else {
            dump('Aucun admin trouvé avec cet ID.');
        }

        
        dump($user->getRole());
        

        dump($user);

        if ($request->isMethod('POST')) {
            if ($request->request->has('delete')) {
                if ($admin) {
                    $user->removeAdmin($admin);
                    $entityManager->remove($admin);
                } if ($organisateur) {
                    $user->removeOrganisateur($organisateur);
                    $entityManager->remove($organisateur);
                } if ($conducteur) {
                    $user->removeConducteur($conducteur);
                    $entityManager->remove($conducteur);
                } if ($client) {
                    $user->removeClient($client);
                    $entityManager->remove($client);
                }

                $entityManager->remove($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_inscription');

            } if ($request->request->has('update')) {
                
                if($form->isSubmitted() && $form->isValid()) {
                    $newPassword = $form->get('mot_de_passe')->getData();
                    dump($newPassword);

                    if ($newPassword) {
                        $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                        $user->setMotDePasse($hashedPassword);
                    }
                    $entityManager->persist($user);
                    $entityManager->flush();

                    return $this->redirectToRoute('app_controller');
                } else {
                    dump('Aucun formulaire trouvé.');
                    dump($form->getErrors(true, false));
                }
            } if ($request->request->has('update_admin')){
                if ($form2->isSubmitted() && $form2->isValid()) {
                    $entityManager->persist($admin);
                    $entityManager->flush();

                    return $this->redirectToRoute('app_controller');
                } else {
                    dump('Aucun formulaire trouvé.');
                    dump($form2->getErrors(true, false));
                }
            
            } if ($request->request->has('update_organisateur')){
                if ($form3->isSubmitted() && $form3->isValid()) {
                    $entityManager->persist($organisateur);
                    $entityManager->flush();

                    return $this->redirectToRoute('app_controller');
                } else {
                    dump('Aucun formulaire trouvé.');
                    dump($form3->getErrors(true, false));
                }
            
            } if ($request->request->has('update_conducteur')){
                if ($form4->isSubmitted() && $form4->isValid()) {
                    $entityManager->persist($conducteur);
                    $entityManager->flush();

                    return $this->redirectToRoute('app_controller');
                } else {
                    dump('Aucun formulaire trouvé.');
                    dump($form4->getErrors(true, false));
                }
            }
        }

        return $this->render('front/account_settings.html.twig', [
            'form' => $form->createView(),
            'form2' => $form2 ? $form2->createView() : null,
            'form3' => $form3 ? $form3->createView() : null,
            'form4' => $form4 ? $form4->createView() : null,
        ]);
    }





    
    


}
