<?php
// src/Entity/Profil.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Profil
{
    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="Personne")
     * @ORM\JoinColumn(name="PER_ID", referencedColumnName="id")
     */
    private $PER_ID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PRO_FONCTION;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ENV_ACCORD;

    /**
     * @ORM\Column(type="integer")
     */
    private $JUR_ANNEE;

    /**
     * @ORM\Column(type="boolean")
     */
    private $TUT_ACCORD;

    /**
     * @ORM\Column(type="boolean")
     */
    private $RES_ACCORD;

    public function getPER_ID(): ?int
    {
        return $this->PER_ID;
    }

    public function setPERID(?Personne $PER_ID): self
    {
        $this->PER_ID = $PER_ID;

        return $this;
    }

    public function getPROFONCTION(): ?string
    {
        return $this->PRO_FONCTION;
    }

    public function setPROFONCTION(string $PRO_FONCTION): self
    {
        $this->PRO_FONCTION = $PRO_FONCTION;

        return $this;
    }

    public function getENVACCORD(): ?bool
    {
        return $this->ENV_ACCORD;
    }

    public function setENVACCORD(bool $ENV_ACCORD): self
    {
        $this->ENV_ACCORD = $ENV_ACCORD;

        return $this;
    }

    public function getJURANNEE(): ?int
    {
        return $this->JUR_ANNEE;
    }

    public function setJURANNEE(int $JUR_ANNEE): self
    {
        $this->JUR_ANNEE = $JUR_ANNEE;

        return $this;
    }

    public function getTUTACCORD(): ?bool
    {
        return $this->TUT_ACCORD;
    }

    public function setTUTACCORD(bool $TUT_ACCORD): self
    {
        $this->TUT_ACCORD = $TUT_ACCORD;

        return $this;
    }

    public function getRESACCORD(): ?bool
    {
        return $this->RES_ACCORD;
    }

    public function setRESACCORD(bool $RES_ACCORD): self
    {
        $this->RES_ACCORD = $RES_ACCORD;

        return $this;
    }
}