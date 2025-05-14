<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Objet = null;

    #[ORM\Column(length: 1000)]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'parcours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Etapes>
     */
    #[ORM\OneToMany(targetEntity: Etapes::class, mappedBy: 'parcours')]
    private Collection $etapes;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->Objet;
    }

    public function setObjet(string $Objet): static
    {
        $this->Objet = $Objet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

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
            $etape->setParcours($this);
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): static
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getParcours() === $this) {
                $etape->setParcours(null);
            }
        }

        return $this;
    }
}
