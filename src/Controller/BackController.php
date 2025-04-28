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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;





final class BackController extends AbstractController{
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
        return $this->redirectToRoute('app_back_login');
    }

    #[Route('/back/account_settings', name: 'app_back_account_settings')] // Correction du slash manquant
    public function parametres_back(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
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

}


