<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Utilisateur;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;

class LoginController extends AbstractController
{

    /**
     * Fonction pour hacher un mot de passe
     *
     * @param string $password Le mot de passe à hacher
     *
     * @return string Le mot de passe haché
     */
    function hashPassword(string $password): string
    {
    // Créer une instance de PasswordHasherFactory
    $passwordHasherFactory = new PasswordHasherFactory([
        // Définir l'algorithme par défaut pour la classe User
        Utilisateur::class => ['algorithm' => 'auto'],
    ]);

    // Récupérer le hasher par défaut pour la classe User
    $passwordHasher = $passwordHasherFactory->getPasswordHasher(Utilisateur::class);
    

    // Hacher le mot de passe
    return $passwordHasher->hash($password);
    }
        /**
     * Fonction pour vérifier la clé de hachage d'un mot de passe
     *
     * @param string $password Le mot de passe en clair
     * @param string $hashedPassword Le mot de passe haché
     *
     * @return bool True si le mot de passe correspond au hachage, false sinon
     */
    function verifyPassword(string $password, string $hashedPassword): bool
    {
        // Créer une instance de PasswordHasherFactory
        $passwordHasherFactory = new PasswordHasherFactory([
            // Définir l'algorithme par défaut pour la classe User
            Utilisateur::class => ['algorithm' => 'auto'],
        ]);

        // Récupérer le hasher par défaut pour la classe User
        $passwordHasher = $passwordHasherFactory->getPasswordHasher(Utilisateur::class);

        // Vérifier le mot de passe
        return $passwordHasher->verify($hashedPassword, $password);
    }
    /**
     * @Route("/login", name="app_login")
     */
    function PageConnxion(Request $requeteHTTP,ManagerRegistry $doctrine){
        if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true) {return $this->redirectToRoute('Stage');}
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $utilisateur = $doctrine->getRepository(Utilisateur::class)->findOneBy(['identifiant' => $_POST['identifiant']]);
            $motdepasse = $utilisateur->verifyPassword();
            if (password_verify($_POST["UTI_password"], $motdepasse)) {
                $_SESSION['isConnected'] = true;
                return $this->redirectToRoute('Stage');
            } else {return $this->render('BDST_PageConnexion.html.twig');}
        } else {
            return $this->render('BDST_PageConnexion.html.twig');
        }
    }
}
