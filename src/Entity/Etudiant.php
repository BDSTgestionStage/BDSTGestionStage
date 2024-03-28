<?php
// src/Entity/Etudiant.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\OneToOne(targetEntity="Personne")
     * @ORM\JoinColumn(name="per_id", referencedColumnName="id")
     */
    private $per_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ETU_ANNEE;

    /**
     * @ORM\ManyToOne(targetEntity="Formation")
     * @ORM\JoinColumn(name="formation_id", referencedColumnName="id")
     */
    private $formation;

    public function getId(): ?int
    {
        return $this->per_id;
    }

    public function getETUANNEE(): ?int
    {
        return $this->ETU_ANNEE;
    }

    public function setETUANNEE(string $ETU_ANNEE): self
    {
        $this->ETU_ANNEE = $ETU_ANNEE;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getPer_Id(): ?Personne
    {
        return $this->per_id;
    }

    public function setPerId(?Personne $per_id): self
    {
        $this->per_id = $per_id;

        return $this;
    }
}