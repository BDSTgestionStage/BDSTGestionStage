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
     * @ORM\Column(type="integer")
     */
    private $id;

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
        return $this->id;
    }

    public function getETUANNEE(): ?int
    {
        return $this->ETU_ANNEE;
    }

    public function setETUANNEE(int $ETU_ANNEE): self
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
}
