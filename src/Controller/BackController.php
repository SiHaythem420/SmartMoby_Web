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
use App\Entity\Evenment;
use App\Form\EvenmentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Form\UtilisateurType;
use App\Form\AdminType;
use App\Form\UtilisateurBackType;
use App\Form\UpdateUtilisateurType;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;




use App\Service\InfobipSmsSender;
use App\Service\GoogleAuthService;
use App\Service\QrCodeService;
use Endroid\QrCode\Builder\BuilderInterface;
use Nucleos\DompdfBundle\Wrapper\DompdfWrapperInterface;
use App\Repository\EvenmentRepository;

final class BackController extends AbstractController
{
    private GoogleAuthService $googleAuthService;

    public function __construct(GoogleAuthService $googleAuthService)
    {
        $this->googleAuthService = $googleAuthService;
    }
     

    #[Route('/back', name: 'app_back')]
    public function index(EntityManagerInterface $entityManager , SessionInterface $session): Response
    {
        $adminId = $session->get('admin_id');

        if (!$adminId) {
            return $this->redirectToRoute('app_back_login');
        }

        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($adminId);

        if ($utilisateur && $utilisateur->getBan()) {
            $session->remove('admin_id'); // Supprime la session pour éviter un accès non autorisé
        $adminId = $session->get('admin_id');

        if (!$adminId) {
            return $this->redirectToRoute('app_back_login');
        }

        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($adminId);

        if ($utilisateur && $utilisateur->getBan()) {
            $session->remove('admin_id'); // Supprime la session pour éviter un accès non autorisé
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
}

    #[Route('/back/login', name: 'app_back_login')]
    public function login(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $error = null;
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $motDePasse = $request->request->get('mot_de_passe');
            dump($email);
            dump($motDePasse);
    
            $utilisateur = $entityManager->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);
    
            if ($utilisateur) {
                if ($utilisateur->getBan()) {
                    $error = 'Votre compte est banni. Veuillez contacter l\'administrateur.';
                } elseif ($utilisateur->getRole() === 'ADMIN' && password_verify($motDePasse, $utilisateur->getMotDePasse())) {
                    $session->set('admin_id', $utilisateur->getId());
                    return $this->redirectToRoute('app_back');
                } else {
                    $error = 'Email ou mot de passe invalide, ou vous n\'êtes pas un administrateur.';
                }
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
            $session->set('admin_id', $utilisateur->getId());
            $session->set('admin_id', $utilisateur->getId());

            return $this->redirectToRoute('app_back');
        }

        return $this->render('back/inscription_admin_back.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/back/logout', name: 'back_logout')]
    public function logout(SessionInterface $session)
    {
        $session->remove('admin_id');
        $session->remove('admin_id');
        return $this->redirectToRoute('app_back_login');
    }

    #[Route('/back/account_settings', name: 'app_back_account_settings')] // Correction du slash manquant
    public function parametres_back(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $userId = $session->get('admin_id');
        $userId = $session->get('admin_id');

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

    #[Route('/back/user/ban/{id}', name: 'user_ban')]
    public function banUser(int $id, EntityManagerInterface $entityManager): Response
    {   
        $user = $entityManager->getRepository(Utilisateur::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé.');
        }

        $user->setBan(true); // Met la variable "ban" à 1
        $entityManager->flush();

        return $this->redirectToRoute('app_back'); // Redirige vers la page principale
    }
    
    #[Route('/back/user/unban/{id}', name: 'user_unban')]
    public function unbanUser(int $id, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(Utilisateur::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé.');
        }

        $user->setBan(false); // Met la variable "ban" à 0
        $entityManager->flush();

        return $this->redirectToRoute('app_back');
    }


    #[Route('/back/export/pdf', name: 'export_users_pdf')]
    public function exportUsersPdf(EntityManagerInterface $entityManager): Response
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Ajouter un titre
        $sheet->setCellValue('A1', 'Liste des Utilisateurs');
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('4F81BD');
        $sheet->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

        // Ajouter les en-têtes
        $headers = ['Nom', 'Prénom', 'Nom d\'utilisateur', 'Email', 'Mot de passe', 'Role', 'Département', 'Badge', 'Permis'];
        $sheet->fromArray($headers, null, 'A3');

        // Style des en-têtes
        $headerStyle = $sheet->getStyle('A3:I3');
        $headerStyle->getFont()->setBold(true)->setSize(12);
        $headerStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('DCE6F1');
        $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $headerStyle->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $users = $entityManager->getRepository(Utilisateur::class)->findAll();
        $admins = $entityManager->getRepository(Admin::class)->findAll();
        $organisateurs = $entityManager->getRepository(Organisateur::class)->findAll();
        $clients = $entityManager->getRepository(Client::class)->findAll();
        $conducteurs = $entityManager->getRepository(Conducteur::class)->findAll();

        $row = 4;
        foreach ($users as $user) {
            // Déterminer le département avant de créer le tableau
            $departement = 'N/A';
            if ($user->getRole() === 'ADMIN') {
                foreach ($admins as $admin) {
                    if ($admin->getId() === $user) {
                        $departement = $admin->getDepartement();
                        break;
                    }
                }
            }

            $badge = 'N/A';
            if ($user->getRole() === 'ORGANISATEUR') {
                foreach ($organisateurs as $organisateur) {
                    if ($organisateur->getId() === $user) {
                        $badge = $organisateur->getNumBadge();
                        break;
                    }
                }
            }

            $permis = 'N/A';
            if ($user->getRole() === 'CONDUCTEUR') {
                foreach ($conducteurs as $conducteur) {
                    if ($conducteur->getId() === $user) {
                        $permis = $conducteur->getNumeroPermis();
                        break;
                    }
                }
            }

            // Créer le tableau avec les valeurs
            $sheet->fromArray([
                $user->getNom(),
                $user->getPrenom(),
                $user->getNomUtilisateur(),
                $user->getEmail(),
                $user->getMotDePasse(),
                $user->getRole(),
                $departement,
                $badge,
                $permis
            ], null, 'A' . $row);

            // Style alterné des lignes
            $rowStyle = $sheet->getStyle('A' . $row . ':I' . $row);
            if ($row % 2 == 0) {
                $rowStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
            }
            $rowStyle->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $rowStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $rowStyle->getFont()->setSize(11);

            $row++;
        }

        // Ajuster la largeur des colonnes
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Ajouter un espacement entre les cellules
        $sheet->getStyle('A1:I' . ($row - 1))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:I' . ($row - 1))->getAlignment()->setWrapText(true);

        $writer = new Mpdf($spreadsheet);
        $filename = 'liste_utilisateurs.pdf';

        ob_start();
        $writer->save('php://output');
        $pdfContent = ob_get_clean();

        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => (new ResponseHeaderBag())->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $filename
            ),
        ]);
    }



    
    
    //oussema
    #[Route('/back/add_event', name: 'app_back_add_event')]
    public function addEvent(
        Request $request,
        EntityManagerInterface $entityManager,
        InfobipSmsSender $messageSender,
        GoogleAuthService $googleAuthService,
        QrCodeService $qrCodeService,
        SessionInterface $session
    ): Response {
        $event = new Evenment();
        $form = $this->createForm(EvenmentType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            $phoneNumber = '21652991996';
            $eventTitle = $event->getNom();
            $messageContent = sprintf(' user, l\'événement sous le nom "%s" a été bien ajouté.', $eventTitle);

            if ($messageSender->sendWhatsAppMessage($phoneNumber, $messageContent)) {
                $this->addFlash('success', 'Le message WhatsApp a été envoyé avec succès.');
            } else {
                $this->addFlash('error', 'Échec de l\'envoi du message WhatsApp.');
            }

            $googleClient = $googleAuthService->getClient();
            if (!$googleClient->getAccessToken()) {
                $authUrl = $googleAuthService->getAuthUrl();
                return $this->redirect($authUrl);
            }

            $startDate = $event->getDate()->format('Y-m-d');
            $endDate = $event->getDate()->format('Y-m-d');

            try {
                $googleAuthService->createEvent([
                    'summary' => $event->getNom(),
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'location' => $event->getLieu(),
                    'attendees' => [],
                ]);
                $this->addFlash('success', 'Événement ajouté avec succès et synchronisé avec Google Calendar.');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur lors de la synchronisation avec Google Calendar: ' . $e->getMessage());
            }

            return $this->generateQrCode($event, $qrCodeService, $session);
        }

        return $this->render('back/add_event.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/event/{id_event}/qr_image', name: 'event_qr_image')]
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

        $qrImage = $qrCodeService->generateQrCodeBinary($data); // retourne l'image binaire (pas enregistré en fichier)

        return new Response($qrImage, 200, [
            'Content-Type' => 'image/png'
        ]);
    }

    #[Route('/events/{id_event}/qr', name: 'event_show_qr')]
    public function showQr(int $id_event, SessionInterface $session, EntityManagerInterface $em): Response
    {
        $qrPath = $session->get('qr_path');

        if (!$qrPath) {
            $this->addFlash('error', 'Aucun QR Code trouvé.');
            return $this->redirectToRoute('app_back_afficher_event');
        }

        $event = $em->getRepository(Evenment::class)->find($id_event);

        if (!$event) {
            throw $this->createNotFoundException('Événement introuvable.');
        }

        return $this->render('back/qr.html.twig', [
            'qrPath' => $qrPath,
            'event' => $event,
        ]);
    }

    private function generateQrCode(Evenment $event, QrCodeService $qrCodeService, SessionInterface $session): Response
    {
        $data = sprintf(
            "Événement : %s\nDate : %s\nLieu : %s",
            $event->getNom(),
            $event->getDate()->format('d/m/Y'),
            $event->getLieu()
        );

        $qrPath = $qrCodeService->generateQrCode($data);
        $session->set('qr_path', $qrPath);

        return $this->redirectToRoute('event_show_qr', [
            'id_event' => $event->getIdEvent()
        ]);
    }

    // pour google calendar AUTH // 
    #[Route('/oauth/callback', name: 'google_oauth_callback')]
    public function googleOauthCallback(Request $request, GoogleAuthService $googleAuthService)
    {
        // Récupère le code de Google dans l'URL
        $accessToken = $googleAuthService->fetchAccessToken($request);

        if ($accessToken) {
            $this->addFlash('success', 'Vous êtes maintenant connecté à Google.');
        } else {
            $this->addFlash('error', 'Échec de l\'authentification avec Google.');
        }

        // Rediriger vers la page d'ajout d'événement ou une autre page
        return $this->redirectToRoute('app_back_add_event');
    }



    


    #[Route('/back/afficher_event', name: 'app_back_afficher_event')]
    public function afficherEvent(EntityManagerInterface $entityManager): Response
    {
        $events = $entityManager->getRepository(Evenment::class)->findAll();
        return $this->render('back/afficher_event.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/back/modifier_event/{id}', name: 'app_back_modifier_event')]
    public function modifierEvent(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = $entityManager->getRepository(Evenment::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Événement non trouvé.');
        }

        $form = $this->createForm(EvenmentType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_back_afficher_event');
        }

        return $this->render('back/modifier_event.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ]);
    }

    #[Route('/back/supprimer_event/{id}', name: 'app_back_supprimer_event')]
    public function supprimerEvent(int $id, EntityManagerInterface $entityManager): Response
    {
        $event = $entityManager->getRepository(Evenment::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Événement non trouvé.');
        }

        $entityManager->remove($event);
        $entityManager->flush();

        return $this->redirectToRoute('app_back_afficher_event');
    }
// src/Controller/BackEventController.php (ou un nom similaire)
/*#[Route('/back/search_event', name: 'search_event', methods: ['GET'])]
public function searchEvent(Request $request, EventRepository $eventRepo, PaginatorInterface $paginator): Response
{
    $query = $request->query->get('q', '');
    $eventsQuery = $eventRepo->createQueryBuilder('e')
        ->where('e.nom LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery();

    $events = $paginator->paginate($eventsQuery, $request->query->getInt('page', 1), 10);

    return $this->render('back/_events_list.html.twig', [
        'events' => $events,
    ]);
}*/

    #[Route('/hybridaction/zybTrackerStatisticsAction', name: 'zyb_tracker_statistics')]
    public function zybTrackerStatisticsAction(Request $request): Response
    {
        // Votre logique de tracking ici
        return new JsonResponse(['status' => 'success']);
    }

    #[Route('/back/events/pdf', name: 'back_events_pdf')]
    public function eventsPdf(EvenmentRepository $evenmentRepository, DompdfWrapperInterface $pdf): Response
    {
        try {
            $events = $evenmentRepository->findAll();

            if (empty($events)) {
                $this->addFlash('warning', 'Aucun événement à afficher.');
                return $this->redirectToRoute('app_back');
            }

            $html = $this->renderView('pdf/back_events_pdf.html.twig', [
                'events' => $events,
            ]);

            return $pdf->streamHtml(
                $html,
                'evenements_admin.pdf',
                [
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'helvetica',
                    'isHtml5ParserEnabled' => true,
                    'dpi' => 150
                ]
            );
        } catch (\Exception $e) {
            $this->addFlash('error', 'Erreur lors de la génération du PDF: ' . $e->getMessage());
            return $this->redirectToRoute('app_back');
        }
    }
}

