<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: "UNIQ_IDENTIFIER_EMAIL", fields: ["email"])]
#[
    UniqueEntity(
        fields: ["email"],
        message: "There is already an account with this email",
    ),
]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroOrdre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $horaires = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $specialites = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'architecte')]
    private Collection $projets;

    /**
     * @var Collection<int, DemandeClient>
     * Demandes assignées à cet architecte
     */
    #[ORM\OneToMany(targetEntity: DemandeClient::class, mappedBy: 'architecte')]
    private Collection $demandeClients;

    /**
     * @var Collection<int, DemandeClient>
     * Demandes envoyées par ce client
     */
    #[ORM\OneToMany(targetEntity: DemandeClient::class, mappedBy: 'client')]
    private Collection $demandesEnvoyees;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\OneToMany(targetEntity: Intervention::class, mappedBy: 'architecte')]
    private Collection $interventions;

    #[ORM\Column]
    private bool $isVerified = false;

    public function __construct()
    {
        $this->createdAt       = new \DateTimeImmutable();
        $this->updatedAt       = new \DateTimeImmutable();
        $this->projets         = new ArrayCollection();
        $this->demandeClients  = new ArrayCollection();
        $this->demandesEnvoyees = new ArrayCollection();
        $this->interventions   = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0" . self::class . "\0password"] = hash('crc32c', $this->password);
        return $data;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getNumeroOrdre(): ?string
    {
        return $this->numeroOrdre;
    }

    public function setNumeroOrdre(string $numeroOrdre): static
    {
        $this->numeroOrdre = $numeroOrdre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(?string $horaires): static
    {
        $this->horaires = $horaires;
        return $this;
    }

    public function getSpecialites(): ?string
    {
        return $this->specialites;
    }

    public function setSpecialites(?string $specialites): static
    {
        $this->specialites = $specialites;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    // ── Projets ──

    /** @return Collection<int, Projet> */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setArchitecte($this);
        }
        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            if ($projet->getArchitecte() === $this) {
                $projet->setArchitecte(null);
            }
        }
        return $this;
    }

    // ── Demandes assignées (côté architecte) ──

    /** @return Collection<int, DemandeClient> */
    public function getDemandeClients(): Collection
    {
        return $this->demandeClients;
    }

    public function addDemandeClient(DemandeClient $demandeClient): static
    {
        if (!$this->demandeClients->contains($demandeClient)) {
            $this->demandeClients->add($demandeClient);
            $demandeClient->setArchitecte($this);
        }
        return $this;
    }

    public function removeDemandeClient(DemandeClient $demandeClient): static
    {
        if ($this->demandeClients->removeElement($demandeClient)) {
            if ($demandeClient->getArchitecte() === $this) {
                $demandeClient->setArchitecte(null);
            }
        }
        return $this;
    }

    // ── Demandes envoyées (côté client) ──

    /** @return Collection<int, DemandeClient> */
    public function getDemandesEnvoyees(): Collection
    {
        return $this->demandesEnvoyees;
    }

    public function addDemandeEnvoyee(DemandeClient $demande): static
    {
        if (!$this->demandesEnvoyees->contains($demande)) {
            $this->demandesEnvoyees->add($demande);
            $demande->setClient($this);
        }
        return $this;
    }

    public function removeDemandeEnvoyee(DemandeClient $demande): static
    {
        if ($this->demandesEnvoyees->removeElement($demande)) {
            if ($demande->getClient() === $this) {
                $demande->setClient(null);
            }
        }
        return $this;
    }

    // ── Interventions ──

    /** @return Collection<int, Intervention> */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions->add($intervention);
            $intervention->setArchitecte($this);
        }
        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            if ($intervention->getArchitecte() === $this) {
                $intervention->setArchitecte(null);
            }
        }
        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;
        return $this;
    }
}