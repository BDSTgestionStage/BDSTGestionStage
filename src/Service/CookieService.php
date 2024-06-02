<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Utilisateur;

class CookieService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function CheckCookieService(Request $request): ?Utilisateur
    {
        $userId = $request->cookies->get('user_id');
        $userToken = $request->cookies->get('user_token');
        $isConnected = $request->cookies->get('connected');

        if (!$userId || !$userToken || !$isConnected) {
            var_dump("Cookies manquants.");
            return null;
        }

        $utilisateur = $this->em->getRepository(Utilisateur::class)->find($userId);

        if (!$utilisateur) {
            var_dump("Utilisateur non trouvé.");
            return null;
        }

        if ($utilisateur->getUTIPassword() !== $userToken) {
          var_dump("Mot de passe incorrect.");
            return null;
        }

        return $utilisateur;
    }
}
?>