<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Utilisateur;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Admin
{

    #[ORM\Id]
        #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: "admins")]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Utilisateur $id;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank( message: 'Le département est obligatoire pour un admin.')]
    private string $departement;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getDepartement()
    {
        return $this->departement;
    }

    public function setDepartement($value)
    {
        $this->departement = $value;
    }
}
