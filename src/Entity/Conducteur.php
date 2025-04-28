<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use App\Entity\Utilisateur;

#[ORM\Entity]
#[UniqueEntity(fields: ['numero_permis'], message: 'Ce numéro de permis est déjà utilisé.')]
class Conducteur
{

    #[ORM\Id]
        #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: "conducteurs")]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Utilisateur $id;

    #[ORM\Column(type: "integer" , unique : true)]
    private int $numero_permis;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getNumeroPermis()
    {
        return $this->numero_permis;
    }

    public function setNumeroPermis($value)
    {
        $this->numero_permis = $value;
    }
}
