<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FOR_LIBELLE;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFORLIBELLE(): ?string
    {
        return $this->FOR_LIBELLE;
    }

    public function setFORLIBELLE(string $FOR_LIBELLE): self
    {
        $this->FOR_LIBELLE = $FOR_LIBELLE;

        return $this;
    }
}
