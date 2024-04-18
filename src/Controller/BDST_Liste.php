<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\Etudiant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; 

class BDST_Liste extends AbstractController
{
    /**
     * @Route("/liste", name="liste")
     */
    public function liste(EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les entreprises
        $entreprises = $entityManager->getRepository(Entreprise::class)->findAll();

        // Tableau pour stocker les étudiants associés à chaque entreprise
        $etudiantsParEntreprise = [];

        // Parcourir chaque entreprise
        foreach ($entreprises as $entreprise) {
            // Récupérer les personnes associées à cette entreprise
            $personnes = $entreprise->getPersonnes();

            // Filtrer uniquement les personnes qui sont des étudiants
            $etudiants = [];
            foreach ($personnes as $personne) {
                // Vérifier si la personne est un étudiant en recherchant son ID dans la table Etudiant
                $etudiant = $entityManager->getRepository(Etudiant::class)->findOneBy(['per_id' => $personne->getId()]);
                if ($etudiant) {
                    $etudiants[] = $personne;
                }
            }

            // Stocker les étudiants associés à cette entreprise dans le tableau
            $etudiantsParEntreprise[$entreprise->getId()] = $etudiants;
        }

        // Passer les entreprises et les étudiants associés à chaque entreprise à la vue pour affichage
        return $this->render('liste.html.twig', [
            'entreprises' => $entreprises,
            'etudiantsParEntreprise' => $etudiantsParEntreprise,
        ]);
    }
        /**
     * @Route("/search", name="search")
     */
    public function search(Request $request)
    {
        $searchTerm = $request->query->get('q', '');

        if (!empty($searchTerm)) {
            $repository = $this->getDoctrine()->getRepository(Entreprise::class);
            $results = $repository->searchByTerm($searchTerm);
        } else {
            $results = [];
        }

        return $this->render('search/results.html.twig', ['results' => $results]);
    }
}
