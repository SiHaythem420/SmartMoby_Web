<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Blog; // Add this import

#[ORM\Entity]
#[ORM\Table(name: 'avis')] // Explicit table name mapping
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(name: "avis_id", type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 255)]
    private string $comment;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity: Blog::class, inversedBy: 'avis')]
    #[ORM\JoinColumn(name: 'blog_id', referencedColumnName: 'blog_id', nullable: false)]
    private Blog $blog;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getBlog(): ?Blog
    {
        return $this->blog;
    }

    public function setBlog(?Blog $blog): static
    {
        $this->blog = $blog;
        return $this;
    }

    
}