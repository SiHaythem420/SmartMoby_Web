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
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $form->get('role')->getData();
            if ($role === 'admin') {
                $utilisateur = $form->getData();
                $request->getSession()->set('utilisateur_data', $utilisateur);

                return $this->redirectToRoute('inscription_admin');
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
            }
        }

        return $this->render('front/login.html.twig', [
            'form' => $form->createView(),
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

    #[Route('/logout', name: 'app_logout')]
    public function logout(SessionInterface $session)
    {
        $session->clear();
        return $this->redirectToRoute('app_inscription');
    }

    #[Route('front/account_settings', name: 'app_account_settings')]
public function parametres(Request $request, SessionInterface $session, EntityManagerInterface $entityManager): Response
{
    $userId = $session->get('user_id');
    dump($userId);

    if (!$userId) {
        return $this->redirectToRoute('app_inscription');
    }

    $user = $entityManager->getRepository(Utilisateur::class)->find($userId);
    dump($user);

    if (!$user) {
        return $this->redirectToRoute('app_inscription');
    }

    $admin = $entityManager->getRepository(Admin::class)->find($userId);
    if ($admin) {
        dump($admin);
    } else {
        dump('Aucun admin trouvé avec cet ID.');
    }

    if ($request->isMethod('POST')) {
        if ($admin) {
            $user->removeAdmin($admin);
            $entityManager->remove($admin);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_inscription');
    }

    return $this->render('front/account_settings.html.twig', [
        'user' => $user,
    ]);
}





    
    


}
