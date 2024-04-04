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
            $identifiant = $request->request->get('identifiant');
            $password = $request->request->get('password');

            // Vérifier si l'utilisateur existe
            $identifiant = $em->getRepository('App\Entity\Utilisateur')->findOneBy(['identifiant' => $identifiant]);

            if (!$identifiant) {
                $this->addFlash('error', 'Utilisateur introuvable.');
                return $this->redirectToRoute('login');
            }

            // Hacher le mot de passe soumis par l'utilisateur avec SHA-256 pour la comparaison
            $hashedPasswordSubmitted = hash('sha256', $password);

            // Comparer les hachages des mots de passe
            if ($identifiant->getUTIPassword() !== $hashedPasswordSubmitted) {
                // Mot de passe incorrect
                $this->addFlash('error', 'Mot de passe incorrect.');
                return $this->redirectToRoute('app_login');
            }           
            // Créer un cookie pour enregistrer la connexion de l'utilisateur
            $cookieid = new Cookie('user_id', $identifiant->getId(), time() + 3600 * 24 * 7);
            $cookiemdp = new Cookie('user_mdp', $identifiant->getUTIPassword(), time() + 3600 * 24 * 7); // Cookie valable pendant 7 jours
            

            // Ajouter le cookie à la réponse
            $response = new Response();
            $response->headers->setCookie($cookieid, $cookiemdp);
            $response->send();
            $this->addFlash('success', 'Connexion réussie.');
            
            // Rediriger vers la page d'accueil ou une autre page
            return $this->redirectToRoute('liste');
        }

        // Afficher le formulaire
        return $this->render('BDST_PageConnexion.html.twig');
    }
}
