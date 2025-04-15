<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Evenment;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Fedback
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

        #[ORM\ManyToOne(targetEntity: Evenment::class, inversedBy: "fedbacks")]
    #[ORM\JoinColumn(name: 'id_event', referencedColumnName: 'id_event', onDelete: 'CASCADE')]
    private Evenment $id_event;

    #[ORM\Column(type: "string", length: 250)]
    #[Assert\NotBlank(message: "Le commentaire est obligatoire.")]
    #[Assert\Length(max: 250, maxMessage: "Le commentaire ne doit pas dépasser {{ limit }} caractères.")]
    private string $commentaire;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "La note est obligatoire.")]
    #[Assert\Range(min: 1, max: 5, notInRangeMessage: "La note doit être comprise entre {{ min }} et {{ max }}.")]
    private int $note;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getIdEvent()
    {
        return $this->id_event;
    }

    public function setIdEvent($value)
    {
        $this->id_event = $value;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setCommentaire($value)
    {
        $this->commentaire = $value;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($value)
    {
        $this->note = $value;
    }
}
