<?php

namespace App\Entity;

use App\Entity\Service;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $idproduit;

    #[ORM\Column(type: 'string', length: 100)]
    private string $nom;

    #[ORM\Column(type: 'string', length: 100)]
    private string $type;

    #[ORM\Column(type: 'integer')]
    private int $prix;

    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'produits')]
    #[ORM\JoinTable(name: 'produit_service')]
    #[ORM\JoinColumn(
        name: 'produit_id',
        referencedColumnName: 'idproduit'
    )]
    #[ORM\InverseJoinColumn(
        name: 'service_id',
        referencedColumnName: 'id_service'
    )]
    private Collection $services;
    

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function setIdproduit(int $idproduit): self
    {
        $this->idproduit = $idproduit;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
        }
        return $this;
    }

    public function removeService(Service $service): self
    {
        $this->services->removeElement($service);
        return $this;
    }
}