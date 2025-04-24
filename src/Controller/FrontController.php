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

use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;


use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Builder\QrCodeBuilderInterface;

use Endroid\QrCode\Builder\BuilderRegistryInterface;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;






final class FrontController extends AbstractController
{
    #[Route('/front', name: 'app_controller')]
    public function index(SessionInterface $session , EntityManagerInterface $entityManager): Response
    {
        $userId = $session->get('user_id');
        
        if (!$session->get('user_id')) {
            // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
            return $this->redirectToRoute('app_inscription');
        }
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($userId);

        if ($utilisateur && $utilisateur->getBan()) {
            $session->remove('user_id'); // Supprime la session pour éviter un accès non autorisé
            return $this->redirectToRoute('app_inscription');
        }
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/front/login', name: 'app_inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManager, SessionInterface $session,   #[Autowire(service: 'scheb_two_factor.security.google_authenticator')] GoogleAuthenticatorInterface $googleAuthenticator): Response
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
    
            if ($utilisateur) {
                if ($utilisateur->getBan()) {
                    $error = "Votre compte est banni, veuillez contacter l'administrateur.";
                } elseif (password_verify($motDePasse, $utilisateur->getMotDePasse())) {
                    
                    $secret = $googleAuthenticator->generateSecret();
                    $utilisateur->setGoogleAuthenticatorSecret($secret);
                    $entityManager->flush();
                        
                    
                    $session->set('user_id', $utilisateur->getId());
                    return $this->redirectToRoute('2fa_login');

                } else {
                    $error = 'Email ou mot de passe invalide';
                }
            } else {
                $error = 'Email ou mot de passe invalide';
            }
        }

        return $this->render('front/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }


    #[Route('/front/2fa', name: '2fa_login')]
    public function twoFactorLogin(
        Request $request, 
        SessionInterface $session, 
        EntityManagerInterface $entityManager, 
        #[Autowire(service: 'scheb_two_factor.security.google_authenticator')] GoogleAuthenticatorInterface $googleAuthenticator
    ): Response {
        $userId = $session->get('user_id');

        if (!$userId) {
            return $this->redirectToRoute('app_inscription');
        }

        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($userId);

        if (!$utilisateur) {
            throw $this->createNotFoundException('Utilisateur introuvable');
        }

        if (!$utilisateur->getGoogleAuthenticatorSecret()) {
            $secret = $googleAuthenticator->generateSecret();
            $qrCodeContent = $googleAuthenticator->getQRContent($utilisateur);
            $renderer = new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            );
            $writer = new Writer($renderer);
            $dataUri = 'data:image/svg+xml;base64,' . base64_encode($writer->writeString($qrCodeContent));

            $utilisateur->setGoogleAuthenticatorSecret($secret);
            $entityManager->flush();
        } else {
            $secret = $utilisateur->getGoogleAuthenticatorSecret();
            $qrCodeContent = $googleAuthenticator->getQRContent($utilisateur);
            $renderer = new ImageRenderer(
                new RendererStyle(400),
                new SvgImageBackEnd()
            );
            $writer = new Writer($renderer);
            $dataUri = 'data:image/svg+xml;base64,' . base64_encode($writer->writeString($qrCodeContent));
        }

        if ($request->isMethod('POST')) {
            $code = $request->request->get('code');
        
            if ($googleAuthenticator->checkCode($utilisateur, $code)) {
                return $this->redirectToRoute('app_controller');
            } else {
                return $this->render('security/2fa_form.html.twig', [
                    'secret' => $secret, 
                    'error' => 'Code incorrect. Veuillez réessayer.',
                    'dataUri' => $dataUri
                ]);
            }
        }

        return $this->render('security/2fa_form.html.twig', [
            'secret' => $secret,
            'dataUri' => $dataUri
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
        $session->remove('user_id');
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
