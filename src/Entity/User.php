<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Parcours::class)]
    private Collection $parcours;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Messages::class)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: RendusActivites::class)]
    private Collection $rendusActivites;

    public function __construct()
    {
        $this->parcours = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->rendusActivites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        // Nettoyage des infos sensibles si nécessaire
    }

    /**
     * @return Collection<int, Parcours>
     */
    public function getParcours(): Collection
    {
        return $this->parcours;
    }

    public function addParcours(Parcours $parcours): static
    {
        if (!$this->parcours->contains($parcours)) {
            $this->parcours->add($parcours);
            $parcours->setUser($this);
        }

        return $this;
    }

    public function removeParcours(Parcours $parcours): static
    {
        if ($this->parcours->removeElement($parcours)) {
            if ($parcours->getUser() === $this) {
                $parcours->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setSender($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): static
    {
        if ($this->messages->removeElement($message)) {
            if ($message->getSender() === $this) {
                $message->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RendusActivites>
     */
    public function getRendusActivites(): Collection
    {
        return $this->rendusActivites;
    }

    public function addRendusActivite(RendusActivites $rendu): static
    {
        if (!$this->rendusActivites->contains($rendu)) {
            $this->rendusActivites->add($rendu);
            $rendu->setUser($this);
        }

        return $this;
    }

    public function removeRendusActivite(RendusActivites $rendu): static
    {
        if ($this->rendusActivites->removeElement($rendu)) {
            if ($rendu->getUser() === $this) {
                $rendu->setUser(null);
            }
        }

        return $this;
    }
}
