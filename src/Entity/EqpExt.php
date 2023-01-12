<?php

namespace App\Entity;

use App\Repository\EqpExtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EqpExtRepository::class)]
class EqpExt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Gite::class, inversedBy: 'eqpExts')]
    private Collection $gite;

    public function __construct()
    {
        $this->gite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Gite>
     */
    public function getGite(): Collection
    {
        return $this->gite;
    }

    public function addGite(Gite $gite): self
    {
        if (!$this->gite->contains($gite)) {
            $this->gite->add($gite);
        }

        return $this;
    }

    public function removeGite(Gite $gite): self
    {
        $this->gite->removeElement($gite);

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
