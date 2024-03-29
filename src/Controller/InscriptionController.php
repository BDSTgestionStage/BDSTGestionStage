<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // Création d'un nouvel utilisateur
        $utilisateur = new Utilisateur();

        // Création du formulaire d'inscription
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le gestionnaire d'entités
            $entityManager = $this->getDoctrine()->getManager();
            
            // Hacher le mot de passe de l'utilisateur avec SHA-256
            $hashedPassword = hash('sha256', $form['uti_password']->getData());
            $utilisateur->setUTIPassword($hashedPassword);

            // Persister l'entité Utilisateur
            $entityManager->persist($utilisateur);
            // Flush pour sauvegarder en base de données
            $entityManager->flush();

            // Redirection vers une autre page après l'inscription
            return $this->redirectToRoute('inscription_success');
        }

        // Affichage du formulaire d'inscription
        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/inscription/success", name="inscription_success")
     */
    public function success(): Response
    {
        // Affichage d'une page de succès après l'inscription
        return $this->render('inscription/success.html.twig');
    }
}