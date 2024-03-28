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
}
