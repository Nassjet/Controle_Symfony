<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $dateHeure = null;

    #[ORM\Column]
    private ?bool $effectue = null;

    // Renommé pour plus de clarté et éviter problème avec "isModalité"
    #[ORM\Column]
    private ?bool $enDistanciel = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function isEffectue(): ?bool
    {
        return $this->effectue;
    }

    public function setEffectue(bool $effectue): static
    {
        $this->effectue = $effectue;
        return $this;
    }

    public function isEnDistanciel(): ?bool
    {
        return $this->enDistanciel;
    }

    public function setEnDistanciel(bool $enDistanciel): static
    {
        $this->enDistanciel = $enDistanciel;
        return $this;
    }
}
