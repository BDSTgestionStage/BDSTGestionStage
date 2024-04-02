<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=App\Repository\EntrepriseRepository::class)
 */
class Entreprise
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
    private $ENT_NOM;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ENT_VILLE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ENT_PAYS;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ENT_SPECIALITE;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ENT_ADRESSE;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $ENT_CP;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="entreprises")
     * @ORM\JoinTable(name="entreprise_formation")
     */
    private $formations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getENTNOM(): ?string
    {
        return $this->ENT_NOM;
    }

    public function setENTNOM(string $ENT_NOM): self
    {
        $this->ENT_NOM = $ENT_NOM;

        return $this;
    }

    public function getENTVILLE(): ?string
    {
        return $this->ENT_VILLE;
    }

    public function setENTVILLE(string $ENT_VILLE): self
    {
        $this->ENT_VILLE = $ENT_VILLE;

        return $this;
    }

    public function getENTPAYS(): ?string
    {
        return $this->ENT_PAYS;
    }

    public function setENTPAYS(?string $ENT_PAYS): self
    {
        $this->ENT_PAYS = $ENT_PAYS;

        return $this;
    }

    public function getENTSPECIALITE(): ?string
    {
        return $this->ENT_SPECIALITE;
    }

    public function setENTSPECIALITE(?string $ENT_SPECIALITE): self
    {
        $this->ENT_SPECIALITE = $ENT_SPECIALITE;

        return $this;
    }

    public function getENTADRESSE(): ?string
    {
        return $this->ENT_ADRESSE;
    }

    public function setENTADRESSE(string $ENT_ADRESSE): self
    {
        $this->ENT_ADRESSE = $ENT_ADRESSE;

        return $this;
    }

    public function getENTCP(): ?string
    {
        return $this->ENT_CP;
    }

    public function setENTCP(string $ENT_CP): self
    {
        $this->ENT_CP = $ENT_CP;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        $this->formations->removeElement($formation);

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }
}
