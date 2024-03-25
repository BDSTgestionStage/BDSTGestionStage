<?php
// src/Entity/Personne.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $PER_NOM;

  

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $PER_PRENOM;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class)
     * @ORM\JoinColumn(name="ENT_ID", referencedColumnName="id")
     */
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPERNOM(): ?string
    {
        return $this->PER_NOM;
    }

    public function setPERNOM(string $PER_NOM): self
    {
        $this->PER_NOM = $PER_NOM;

        return $this;
    }

  

    public function getPERPRENOM(): ?string
    {
        return $this->PER_PRENOM;
    }

    public function setPERPRENOM(string $PER_PRENOM): self
    {
        $this->PER_PRENOM = $PER_PRENOM;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}