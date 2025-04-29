<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\Organisateur;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity]
#[UniqueEntity(fields: ['email'], message: 'Cet email est déjà utilisé.')]
#[UniqueEntity(fields: ['nom_utilisateur'], message: 'Ce nom d\'utilisateur est déjà pris.')]
class Utilisateur implements PasswordAuthenticatedUserInterface, UserInterface, TwoFactorInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null ;

    #[ORM\Column(type: "string", length: 200)]
    #[Assert\NotBlank(message:'Nom requis !')]
    #[Assert\Regex(
        pattern: '/^[A-Z][a-zA-Z\s]*$/',
        message: 'Le nom doit commencer par une majuscule et ne contient pas des chiffres ou des symboles.'
    )]
    private string $nom;

    #[ORM\Column(type: "string", length: 200)]
    #[Assert\NotBlank(message:'Prénom requis !')]
    #[Assert\Regex(
        pattern: '/^[A-Z][a-zA-Z\s]*$/',
        message: 'Le prénom doit commencer par une majuscule et ne contient pas des chiffres ou des symboles.'
    )]
    private string $prenom;

    #[ORM\Column(type: "string", length: 200)]
    #[Assert\NotBlank(message:"Nom D'utilisateur requis !")]
    #[Assert\Regex(
        pattern: '/^[A-Z][a-zA-Z0-9]*\d+$/',
        message: "Le nom d'utilisateur doit commencer par une majuscule et contient au moins un chiffre."
    )]
    private string $nom_utilisateur;

    #[ORM\Column(type: "string", length: 200, unique: true)]
    #[Assert\NotBlank(message:"Email requis !")]
    #[Assert\Email(message:'Email non valide !')]
    private string $email;

    #[ORM\Column(type: "string", length: 200 , unique : true)]
    #[Assert\NotBlank(message:"Mot De Passe requis !")]
    #[Assert\Length(
        min: 8,
        minMessage: "Le mot de passe doit contenir au moins {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: '/\d/',
        message: "Le mot de passe doit contenir au moins un chiffre."
    )]
    private string $mot_de_passe;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank(message: "Le rôle est requis !")]
    #[Assert\Choice(
        choices: ['client', 'admin', 'conducteur', 'organisateur'],
        message: "Le rôle sélectionné n'est pas valide."
    )]
    private string $role;

    #[ORM\Column(type: "string", length: 6 , nullable : true)]
    private string $reset_code;

    #[ORM\Column(type: 'boolean')]
    private bool $ban = false;

<<<<<<< HEAD
=======
    #[ORM\Column(type: 'string', nullable: true)]

    private ?string $googleAuthenticatorSecret;

>>>>>>> 2bbb1cd508c09daef7ff0e404e25083f9f501b0c
    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($value)
    {
        $this->nom = $value;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($value)
    {
        $this->prenom = $value;
    }

    public function getNomUtilisateur()
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur($value)
    {
        $this->nom_utilisateur = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse($value)
    {
        $this->mot_de_passe = $value;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($value)
    {
        $this->role = $value;
    }

    public function getResetCode()
    {
        return $this->reset_code;
    }

    public function setResetCode($value)
    {
        $this->reset_code = $value;
    }

    public function getPassword(): ?string
    {
        return $this->getMotDePasse();
    }

    public function setPassword(string $password): self
    {
        $this->setMotDePasse($password) ;

        return $this;
    }

    public function getBan(): bool
    {
        return $this->ban;
    }

    public function setBan(bool $ban): self
    {
        $this->ban = $ban;

        return $this;
    }

<<<<<<< HEAD
=======
    public function getGoogleAuthenticatorSecret(): ?string
    {
        return $this->googleAuthenticatorSecret;
    }

    public function setGoogleAuthenticatorSecret(?string $googleAuthenticatorSecret): void
    {
        $this->googleAuthenticatorSecret = $googleAuthenticatorSecret;
    }

>>>>>>> 2bbb1cd508c09daef7ff0e404e25083f9f501b0c
    #[ORM\OneToMany(mappedBy: "id", targetEntity: Admin::class)]
    private Collection $admins;
    public function __construct()
    {
        $this->admins = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->conducteurs = new ArrayCollection();
        $this->organisateurs = new ArrayCollection();
    }

        public function getAdmins(): Collection
        {
            return $this->admins;
        }
    
        public function addAdmin(Admin $admin): self
        {
            if (!$this->admins->contains($admin)) {
                $this->admins[] = $admin;
                $admin->setId($this);
            }
    
            return $this;
        }
    
        public function removeAdmin(Admin $admin): self
        {
            if ($this->admins->removeElement($admin)) {
                
            }
    
            return $this;
        }

    #[ORM\OneToMany(mappedBy: "id", targetEntity: Client::class)]
    private Collection $clients;
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setId($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            
        }

        return $this;
    }

    #[ORM\OneToMany(mappedBy: "id", targetEntity: Conducteur::class)]
    private Collection $conducteurs;
    public function getConducteurs(): Collection
    {
        return $this->conducteurs;
    }

    public function addConducteur(Conducteur $conducteur): self
    {
        if (!$this->conducteurs->contains($conducteur)) {
            $this->conducteurs[] = $conducteur;
            $conducteur->setId($this);
        }

        return $this;
    }

    public function removeConducteur(Conducteur $conducteur): self
    {
        if ($this->conducteurs->removeElement($conducteur)) {
            
        }

        return $this;
    }

    #[ORM\OneToMany(mappedBy: "id", targetEntity: Organisateur::class)]
    private Collection $organisateurs;
    public function getOrganisateurs(): Collection
    {
        return $this->organisateurs;
    }
    public function addOrganisateur(Organisateur $organisateur): self
    {
        if (!$this->organisateurs->contains($organisateur)) {
            $this->organisateurs[] = $organisateur;
            $organisateur->setId($this);
        }

        return $this;
    }
    public function removeOrganisateur(Organisateur $organisateur): self
    {
        if ($this->organisateurs->removeElement($organisateur)) {
            
        }

        return $this;

    
    }

    public function isGoogleAuthenticatorEnabled(): bool
    {
        return null !== $this->googleAuthenticatorSecret;
    }

    public function getGoogleAuthenticatorUsername(): string
    {
        return $this->nom_utilisateur;
    }

    

    public function getRoles(): array
    {
        // Retourne les rôles de l'utilisateur
        $roles = [$this->role];
        $roles[] = 'ROLE_USER'; // Ajoute un rôle par défaut
        return array_unique($roles);
    }

    public function getUserIdentifier(): string
    {
        // Utilise l'email comme identifiant unique
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        // Si vous stockez des données sensibles temporaires, nettoyez-les ici
    }
}
