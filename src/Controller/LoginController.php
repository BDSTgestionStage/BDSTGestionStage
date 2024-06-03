<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Utilisateur;
use App\Entity\Role; // Import the Role entity

class LoginController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function PageConnexion(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        // Traitement du formulaire
        if ($request->isMethod('POST')) {
            // Récupérer l'identifiant et le mot de passe soumis dans le formulaire
            $identifiant = $request->request->get('identifiant');
            $password = $request->request->get('password');

            // Vérifier si l'utilisateur existe
            $utilisateur = $em->getRepository(Utilisateur::class)->findOneBy(['identifiant' => $identifiant]);

            if (!$utilisateur) {
                $this->addFlash('error', 'Utilisateur introuvable.');
                return $this->redirectToRoute('app_login');
            }

            // Hacher le mot de passe soumis par l'utilisateur avec SHA-256 pour la comparaison
            $hashedPasswordSubmitted = hash('sha256', $password);

            // Comparer les hachages des mots de passe
            if ($utilisateur->getUTIPassword() !== $hashedPasswordSubmitted) {
                // Mot de passe incorrect
                $this->addFlash('error', 'Mot de passe incorrect.');
                return $this->redirectToRoute('app_login');
            }
            // Créer un cookie pour enregistrer la connexion de l'utilisateur

            // Créer un cookie pour enregistrer la connexion de l'utilisateur
            $cookieid = new Cookie('user_id', $utilisateur->getId(), time() + 3600 * 24 * 7);
            $cookiemdp = new Cookie('user_token', $utilisateur->getUTIPassword(), time() + 3600 * 24 * 7); // Cookie valable pendant 7 jours
            $cookieconnected = new Cookie('connected', true, time() + 3600 * 24 * 7);
            $cookieRole = new Cookie('user_role', $utilisateur->getRole()->getROLLIBELLE(), time() + 3600 * 24 * 7); // Cookie valable pendant 7 jours





            

            // Ajouter le cookie à la réponse
            $response = new Response();
            $response->headers->setCookie($cookieid);
            $response->headers->setCookie($cookiemdp);
            $response->headers->setCookie($cookieconnected);
            $response->headers->setCookie($cookieRole);

            $response->send();
            $this->addFlash('success', 'Connexion réussie.');

            // Rediriger vers la page d'accueil ou une autre page
            return $this->redirectToRoute('liste');
        }

        // Afficher le formulaire
        return $this->render('BDST_PageConnexion.html.twig');
    }

    // deconnection 
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // Supprimer les cookies
        $response = new Response();
        $response->headers->clearCookie('user_id');
        $response->headers->clearCookie('user_token');
        $response->headers->clearCookie('connected');
        $response->headers->clearCookie('user_role');
        $response->send();

        // Rediriger vers la page de connexion
        return $this->redirectToRoute('app_login');
    }
}
