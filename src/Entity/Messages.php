<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $Contenu = null;

    #[ORM\Column]
    private ?\DateTime $DateHeure = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'messages')]
    private ?User $sender = null;


    /**
     * @var Collection<int, RendusActivites>
     */
    #[ORM\ManyToMany(targetEntity: RendusActivites::class, inversedBy: 'messages')]
    private Collection $rendusActivites;

    public function __construct()
    {
        $this->rendusActivites = new ArrayCollection();
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

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(?string $Contenu): static
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getDateHeure(): ?\DateTime
    {
        return $this->DateHeure;
    }

    public function setDateHeure(\DateTime $DateHeure): static
    {
        $this->DateHeure = $DateHeure;

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
        }

        return $this;
    }

    public function removeRendusActivite(RendusActivites $rendusActivite): static
    {
        $this->rendusActivites->removeElement($rendusActivite);

        return $this;
    }
    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): static
    {
        $this->sender = $sender;
        return $this;
    }

    
}
