<?php

namespace App\Entity;

use App\Repository\RendusActivitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendusActivitesRepository::class)]
class RendusActivites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column]
    private ?\DateTime $dateHeure = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'rendusActivites')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Messages::class, mappedBy: 'rendusActivites')]
    private Collection $messages;

    #[ORM\ManyToMany(targetEntity: Etapes::class, inversedBy: 'rendusActivites')]
    private Collection $etapes;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->etapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;
        return $this;
    }

    public function getDateHeure(): ?\DateTime
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTime $dateHeure): static
    {
        $this->dateHeure = $dateHeure;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
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
            $message->addRendusActivite($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): static
    {
        if ($this->messages->removeElement($message)) {
            $message->removeRendusActivite($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Etapes>
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etapes $etape): static
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes->add($etape);
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): static
    {
        $this->etapes->removeElement($etape);
        return $this;
    }
}
