<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CookieService;

/**
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
    private $CookieService;

    public function __construct(CookieService $CookieService)
    {
        $this->CookieService = $CookieService;
    }
    /**
     * @Route("/", name="personne_index", methods={"GET"})
     */
    public function index(PersonneRepository $personneRepository, Request $request): Response
    {
        $utilisateur = $this->CookieService->CheckCookieService($request);
        if (!$utilisateur) {
            
            return $this->redirectToRoute('app_login');
        }
        return $this->render('personne/index.html.twig', [
            'personnes' => $personneRepository->findAll(),
        ]);
    }

    // Autres actions du CRUD...

}
