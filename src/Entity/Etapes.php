<?php

namespace App\Entity;

use App\Repository\EtapesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapesRepository::class)]
class Etapes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Descriptif = null;

    #[ORM\Column(length: 1000)]
    private ?string $Consignes = null;

    #[ORM\Column]
    private ?int $Position = null;

    #[ORM\ManyToOne(inversedBy: 'etapes')]
    private ?Parcours $parcours = null;

    /**
     * @var Collection<int, RendusActivites>
     */
    #[ORM\ManyToMany(targetEntity: RendusActivites::class, mappedBy: 'etapes')]
    private Collection $rendusActivites;

    #[ORM\ManyToOne(inversedBy: 'etapes')]
    private ?Ressources $ressources = null;

    public function __construct()
    {
        $this->rendusActivites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptif(): ?string
    {
        return $this->Descriptif;
    }

    public function setDescriptif(string $Descriptif): static
    {
        $this->Descriptif = $Descriptif;

        return $this;
    }

    public function getConsignes(): ?string
    {
        return $this->Consignes;
    }

    public function setConsignes(string $Consignes): static
    {
        $this->Consignes = $Consignes;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->Position;
    }

    public function setPosition(int $Position): static
    {
        $this->Position = $Position;

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): static
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * @return Collection<int, RendusActivites>
     */
    public function getRendusActivites(): Collection
    {
        return $this->rendusActivites;
    }

    public function addRendusActivite(RendusActivites $rendusActivite): static
    {
        if (!$this->rendusActivites->contains($rendusActivite)) {
            $this->rendusActivites->add($rendusActivite);
            $rendusActivite->addEtape($this);
        }

        return $this;
    }

    public function removeRendusActivite(RendusActivites $rendusActivite): static
    {
        if ($this->rendusActivites->removeElement($rendusActivite)) {
            $rendusActivite->removeEtape($this);
        }

        return $this;
    }

    public function getRessources(): ?Ressources
    {
        return $this->ressources;
    }

    public function setRessources(?Ressources $ressources): static
    {
        $this->ressources = $ressources;

        return $this;
    }
}
