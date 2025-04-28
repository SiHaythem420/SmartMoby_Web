<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
use App\Entity\Evenment;
use App\Form\FedbackType;
use App\Entity\Fedback;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\EvenmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\EventRepository;                          
use Nucleos\DompdfBundle\Wrapper\DompdfWrapperInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse; // Si tu utilises KnpSnappy
use Dompdf\Dompdf; // ou si tu utilises Dompdf directement
use Dompdf\Options;





final class FrontController extends AbstractController
{
    #[Route('/front', name: 'app_controller')]
    public function index(SessionInterface $session , EntityManagerInterface $entityManager): Response
    {
        $userId = $session->get('user_id');
        $events = $entityManager->getRepository(Evenment::class)->findAll();
        
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
            'events' => $events,
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
    
            if ($utilisateur) {
                if ($utilisateur->getBan()) {
                    $error = "Votre compte est banni, veuillez contacter l'administrateur.";
                } elseif (password_verify($motDePasse, $utilisateur->getMotDePasse())) {
                    $session->set('user_id', $utilisateur->getId());
                    return $this->redirectToRoute('app_controller');
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

    //oussema
    #[Route('/events', name: 'afficher_event')]
    public function afficherEvents(Request $request, EvenmentRepository $evenmentRepository, PaginatorInterface $paginator): Response
    {
        $query = $evenmentRepository->createQueryBuilder('e')
            ->orderBy('e.date', 'DESC')
            ->getQuery();
    
        $events = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            8
        );
    
        return $this->render('front/afficher_event.html.twig', [
            'events' => $events,
        ]);
    }
    

    

    #[Route('/search-events', name: 'search_events')]
    public function searchEvents(Request $request, EvenmentRepository $evenmentRepository): JsonResponse
    {
        $query = $request->query->get('query', '');
        $sort = $request->query->get('sort', 'date_desc');
        
        $events = $evenmentRepository->searchAndSortEvents($query, $sort);
        
        $eventsData = [];
        foreach ($events as $event) {
            $eventsData[] = [
                'id' => $event->getIdEvent(),
                'nom' => $event->getNom(),
                'date' => $event->getDate()->format('Y-m-d'),
                'location' => $event->getLieu(),
            ];
        }
        
        return new JsonResponse(['events' => $eventsData]);
    }
    
    


    
    #[Route('/api/events', name: 'get_events', methods: ['GET'])]
    public function getEvents(EvenmentRepository $evenmentRepository): JsonResponse
    {
        // Récupérer tous les événements depuis la base de données
        $events = $evenmentRepository->findAll();
    
        // Si la liste des événements est vide, retourner un tableau vide
        if (empty($events)) {
            return new JsonResponse([], 200);  // Retourne un tableau vide avec un code 200
        }
    
        // Formatage des événements pour les renvoyer dans la réponse
        $eventsData = [];
        foreach ($events as $event) {
            $eventsData[] = [
                'id' => $event->getId(),
                'nom' => $event->getNom(),
                'date' => $event->getDate()->format('Y-m-d'),
                'lieu' => $event->getLieu(),
            ];
        }
    
        // Retourner les événements sous forme de JSON
        return new JsonResponse($eventsData, 200);
    }
    


    
#[Route('/front/ajouter_fedback/{id}', name: 'ajouter_fedback')]
public function ajouterFedback(Request $request, EntityManagerInterface $entityManager, SessionInterface $session, ?int $id): Response
{
    // Vérifiez si l'utilisateur est connecté
    $userId = $session->get('user_id');
    if (!$userId) {
        dump('Utilisateur non connecté, redirection vers la page d\'inscription.');
        return $this->redirectToRoute('app_inscription');
    }

    // Récupérez l'événement
    $event = $entityManager->getRepository(Evenment::class)->find($id);
    if (!$event) {
        dump('Événement non trouvé avec l\'ID : ' . $id);
        throw $this->createNotFoundException('Événement non trouvé.');
    }
    dump('Événement trouvé : ', $event);

    // Créez le formulaire
    $form = $this->createForm(FedbackType::class);
    $form->handleRequest($request);

    // Vérifiez si le formulaire est soumis
    if ($form->isSubmitted()) {
        dump('Formulaire soumis.');

        // Vérifiez si le formulaire est valide
        if ($form->isValid()) {
            dump('Formulaire valide.');

            // Récupérez les données du formulaire
            $fedback = $form->getData();
            dump('Données du fedback : ', $fedback);

            // Associez l'événement au fedback
            $fedback->setIdEvent($event);
            dump('Fedback associé à l\'événement.');

            // Persistez et sauvegardez dans la base de données
            $entityManager->persist($fedback);
            $entityManager->flush();
            dump('Fedback enregistré avec succès.');

            // Redirection après succès
            return $this->redirectToRoute('afficher_event');
        } else {
            dump('Formulaire invalide : ', $form->getErrors(true, false));
        }
    } else {
        dump('Formulaire non soumis.');
    }

    // Rendu du formulaire
    return $this->render('front/ajouter_fedback.html.twig', [
        'controller_name' => 'FrontController',
        'form' => $form->createView(),
        'event' => $event,
    ]);
}
#[Route('/front/afficher_fedback/{id}', name: 'afficher_fedback')]
public function afficherFedback(EntityManagerInterface $entityManager, ?int $id): Response
{
    // Récupérez l'événement
    $event = $entityManager->getRepository(Evenment::class)->find($id);
    if (!$event) {
        dump('Événement non trouvé avec l\'ID : ' . $id);
        throw $this->createNotFoundException('Événement non trouvé.');
    }
    dump('Événement trouvé : ', $event);

    // Récupérez les fedbacks associés à l'événement
    $fedbacks = $entityManager->getRepository(Fedback::class)->findBy(['id_event' => $event]);
    dump('Fedbacks trouvés : ', $fedbacks);

    return $this->render('front/afficher_fedback.html.twig', [
        'controller_name' => 'FrontController',
        'fedbacks' => $fedbacks,
        'event' => $event,
    ]);
}

    #[Route('/front/modifier_fedback/{idFedback}', name: 'modifier_fedback')]
    public function modifierFedback(Request $request, EntityManagerInterface $entityManager, ?int $idFedback): Response
    {
        // Récupérez le fedback à modifier
        $fedback = $entityManager->getRepository(Fedback::class)->find($idFedback);
        if (!$fedback) {
            dump('Fedback non trouvé avec l\'ID : ' . $idFedback);
            throw $this->createNotFoundException('Fedback non trouvé.');
        }
        dump('Fedback trouvé : ', $fedback);

        // Créez le formulaire
        $form = $this->createForm(FedbackType::class, $fedback);
        $form->handleRequest($request);

        // Vérifiez si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            dump('Formulaire soumis et valide.');

            // Persistez et sauvegardez dans la base de données
            $entityManager->persist($fedback);
            $entityManager->flush();
            dump('Fedback modifié avec succès.');

            // Redirection après succès
            return $this->redirectToRoute('afficher_fedback', ['id' => $fedback->getIdEvent()->getIdEvent()]);
        } else {
            dump('Formulaire invalide : ', $form->getErrors(true, false));
        }

        // Rendu du formulaire
        return $this->render('front/modifier_fedback.html.twig', [
            'controller_name' => 'FrontController',
            'form' => $form->createView(),
            'fedback' => $fedback,
        ]);
    }

    #[Route('/front/supprimer_fedback/{idFedback}', name: 'supprimer_fedback')]
    public function supprimerFedback(EntityManagerInterface $entityManager, ?int $idFedback): Response
    {
        // Récupérez le fedback à supprimer
        $fedback = $entityManager->getRepository(Fedback::class)->find($idFedback);
        if (!$fedback) {
            dump('Fedback non trouvé avec l\'ID : ' . $idFedback);
            throw $this->createNotFoundException('Fedback non trouvé.');
        }
        dump('Fedback trouvé : ', $fedback);

        // Supprimez le fedback de la base de données
        $entityManager->remove($fedback);
        $entityManager->flush();
        dump('Fedback supprimé avec succès.');

        // Redirection après succès
        return $this->redirectToRoute('afficher_fedback', ['id' => $fedback->getIdEvent()->getIdEvent()]);
    }
    #[Route('/events/pdf', name: 'afficherevent_pdf')]
public function eventsPdf(EvenmentRepository $repo): Response
{
    $events = $repo->findAll();

    $html = $this->renderView('pdf/afficherevent_pdf.html.twig', [
        'events' => $events,
    ]);

    // Configure Dompdf
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);

    // Charge ton HTML
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Génère le PDF
    $pdfContent = $dompdf->output();

    return new Response($pdfContent, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="evenements.pdf"',
    ]);
}



#[Route('/front/event/{id_event}/qr_image', name: 'front_event_qr_image')]
public function generateQrImage(int $id_event, EntityManagerInterface $em, QrCodeService $qrCodeService): Response
{
    $event = $em->getRepository(Evenment::class)->find($id_event);

    if (!$event) {
        throw $this->createNotFoundException('Événement introuvable.');
    }

    $data = sprintf(
        "Événement : %s\nDate : %s\nLieu : %s",
        $event->getNom(),
        $event->getDate()->format('d/m/Y'),
        $event->getLieu()
    );

    $qrImage = $qrCodeService->generateQrCodeBinary($data);

    return new Response($qrImage, 200, [
        'Content-Type' => 'image/png',
        'Cache-Control' => 'no-cache, must-revalidate'
    ]);
}
}