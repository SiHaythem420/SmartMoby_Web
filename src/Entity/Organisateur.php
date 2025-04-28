<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use App\Entity\Utilisateur;

#[ORM\Entity]
#[UniqueEntity(fields: ['num_badge'], message: 'Ce numéro de badge est déjà utilisé.')]
class Organisateur
{

    #[ORM\Id]
        #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: "organisateurs")]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Utilisateur $id;

    #[ORM\Column(type: "integer" , unique :true)]
    private int $num_badge;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getNumBadge()
    {
        return $this->num_badge;
    }

    public function setNumBadge($value)
    {
        $this->num_badge = $value;
    }
}
