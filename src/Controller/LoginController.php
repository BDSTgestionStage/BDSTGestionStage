<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Utilisateur;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    function PageConnxion(Request $requeteHTTP,ManagerRegistry $doctrine){
        if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true) {return $this->redirectToRoute('ListeEntreprise');}
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $utilisateur = $doctrine->getRepository(Utilisateur::class)->findOneBy(['identifiant' => $_POST['identifiant']]);
            $mdp = $utilisateur->getUTIPassword();
            print_r($mdp);
            $mdphache = password_verify($_POST["password"], $mdp);
            print_r($mdphache);
            if (password_verify($_POST["password"], $mdp)) {
                $_SESSION['isConnected'] = true;
                return $this->redirectToRoute('liste');
            } else {
                return $this->render('BDST_PageConnexion.html.twig' , ['erreur' => $mdphache]);
                
            }
        } else {
            return $this->render('BDST_PageConnexion.html.twig' , ['erreur' => 'bug']);
        }
    }
}