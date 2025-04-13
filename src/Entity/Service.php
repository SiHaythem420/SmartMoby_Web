<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id_service;

    #[ORM\Column(type: "string", length: 100)]
    #[Assert\NotBlank(message: "Le nom du service est obligatoire")]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: "Le nom doit faire au moins {{ limit }} caractères",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères"
    )]
    private string $nom;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message: "La description est obligatoire")]
    #[Assert\Length(
        min: 10,
        minMessage: "La description doit faire au moins {{ limit }} caractères"
    )]
    private string $description;

    #[ORM\Column(type: "float")]
    #[Assert\NotBlank(message: "Le tarif est obligatoire")]
    #[Assert\Positive(message: "Le tarif doit être un nombre positif")]
    #[Assert\Type(
        type: 'float',
        message: 'Le tarif {{ value }} doit être un nombre valide.'
    )]
    private float $tarif;

    #[ORM\ManyToOne(inversedBy: 'services')]
    #[Assert\NotNull(message: "La catégorie est obligatoire")]
    private ?Categorie $categorie = null;

    public function getId_service()
    {
        return $this->id_service;
    }

    public function setId_service($value)
    {
        $this->id_service = $value;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($value)
    {
        $this->nom = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getTarif()
    {
        return $this->tarif;
    }

    public function setTarif($value)
    {
        $this->tarif = $value;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;
        return $this;
    }
}