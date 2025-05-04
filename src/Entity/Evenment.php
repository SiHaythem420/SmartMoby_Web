<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Entity\Fedback;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Evenment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id_event;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: "Le nom de l'événement ne peut pas être vide")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z0-9\s\-éèêëàâäôöûüçÉÈÊËÀÂÄÔÖÛÜÇ]+$/",
        message: "Le nom ne peut contenir que des lettres, chiffres et espaces"
    )]
    private string $nom;

    #[ORM\Column(type: "date")]
    #[Assert\NotBlank(message: "La date de l'événement ne peut pas être vide")]
    #[Assert\GreaterThanOrEqual(
        "today",
        message: "La date de l'événement doit être aujourd'hui ou dans le futur"
    )]
    private \DateTimeInterface $date;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: "Le lieu de l'événement ne peut pas être vide")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le lieu doit contenir au moins {{ limit }} caractères",
        maxMessage: "Le lieu ne peut pas dépasser {{ limit }} caractères"
    )]
    private string $lieu;

    #[ORM\OneToMany(mappedBy: "id_event", targetEntity: Fedback::class)]
    private Collection $fedbacks;


 
    public function getId_event(): int
    {
        return $this->id_event;
    }
    

    public function setId_event(int $value): self
    {
        $this->id_event = $value;
        return $this;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $value): self
    {
        $this->nom = trim($value);
        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $value): self
    {
        $this->date = $value;
        return $this;
    }

    public function getLieu(): string
    {
        return $this->lieu;
    }

    public function setLieu(string $value): self
    {
        $this->lieu = trim($value);
        return $this;
    }

    public function getFedbacks(): Collection
    {
        return $this->fedbacks;
    }

    public function addFedback(Fedback $fedback): self
    {
        if (!$this->fedbacks->contains($fedback)) {
            $this->fedbacks[] = $fedback;
            $fedback->setId_event($this);
        }

        return $this;
    }

    public function removeFedback(Fedback $fedback): self
    {
        if ($this->fedbacks->removeElement($fedback)) {
            if ($fedback->getId_event() === $this) {
                $fedback->setId_event(null);
            }
        }

        return $this;
    }

}