<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
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
    private $ROL_LIBELLE;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getROLLIBELLE(): ?string
    {
        return $this->ROL_LIBELLE;
    }

    public function setROLLIBELLE(string $ROL_LIBELLE): self
    {
        $this->ROL_LIBELLE = $ROL_LIBELLE;

        return $this;
    }
}
