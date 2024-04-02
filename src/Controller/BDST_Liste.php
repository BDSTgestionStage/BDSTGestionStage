<?php

namespace App\Controller;

use App\Entity\Entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BDST_Liste extends AbstractController
{
    /**
     * @Route("/liste", name="liste")
     */
    public function liste(): Response
    {
        // Récupérer le repository de l'entité Entreprise
        $entrepriseRepository = $this->getDoctrine()->getRepository(Entreprise::class);

        // Récupérer toutes les entreprises
        $entreprises = $entrepriseRepository->findAll();

        // Passer les entreprises à la vue pour affichage
        return $this->render('liste.html.twig', [
            'entreprises' => $entreprises,
        ]);
    }
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les entreprises
        $entreprises = $entityManager->getRepository(Entreprise::class)->findAll();

        $tuteurs = [];
        $personnesEnvAccord = [];
        foreach ($entreprises as $entreprise) {
            foreach ($entreprise->getPersonnes() as $personne) {
                $profil = $personne->getProfil();
                if ($profil && $profil->getTUTACCORD()) {
                    // Ajoutez cette personne à la liste des tuteurs
                    $tuteurs[] = $personne;
                }
                if ($profil && $profil->getENVACCORD()) {
                    // Ajouter cette personne à la liste des personnes avec ENV_ACCORD à true
                    $personnesEnvAccord[] = $personne;
                }
            }
        }

    }

    

}
