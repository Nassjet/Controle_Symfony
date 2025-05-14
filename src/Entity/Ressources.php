<?php

namespace App\Entity;

use App\Repository\RessourcesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RessourcesRepository::class)]
class Ressources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $presentation = null;

    #[ORM\Column(length: 255)]
    private ?string $Support = null;

    #[ORM\Column(length: 255)]
    private ?string $Nature = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    /**
     * @var Collection<int, Etapes>
     */
    #[ORM\OneToMany(targetEntity: Etapes::class, mappedBy: 'ressources')]
    private Collection $etapes;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getSupport(): ?string
    {
        return $this->Support;
    }

    public function setSupport(string $Support): static
    {
        $this->Support = $Support;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->Nature;
    }

    public function setNature(string $Nature): static
    {
        $this->Nature = $Nature;

        return $this;
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
            $etape->setRessources($this);
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): static
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getRessources() === $this) {
                $etape->setRessources(null);
            }
        }

        return $this;
    }
}
