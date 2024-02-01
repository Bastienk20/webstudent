<?php

namespace App\Entity;

use App\Repository\BaguetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: BaguetteRepository::class)]
#[Broadcast]
class Baguette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $taille = null;

    #[ORM\ManyToMany(targetEntity: Composant::class, inversedBy: 'baguettes')]
    private Collection $composants;

    public function __construct()
    {
        $this->composants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection<int, Composant>
     */
    public function getComposants(): Collection
    {
        return $this->composants;
    }

    public function addComposant(Composant $composant): static
    {
        if (!$this->composants->contains($composant)) {
            $this->composants->add($composant);
        }

        return $this;
    }

    public function removeComposant(Composant $composant): static
    {
        $this->composants->removeElement($composant);

        return $this;
    }
}
