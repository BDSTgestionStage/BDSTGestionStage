<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BDST_PageConnection extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // Si l'utilisateur est déjà authentifié, le rediriger vers la page d'accueil
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // Erreur d'authentification
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier nom d'utilisateur entré
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('BDST_PageConnection.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }
  }
?>