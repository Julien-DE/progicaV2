<?php

namespace App\Entity;

use App\Repository\EqpIntRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EqpIntRepository::class)]
class EqpInt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'eqpInt', targetEntity: GiteEqpInt::class,cascade:['persist'])]
    private Collection $giteEqpInts;

    public function __construct()
    {
        $this->giteEqpInts = new ArrayCollection();
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
     * @return Collection<int, GiteEqpInt>
     */
    public function getGiteEqpInts(): Collection
    {
        return $this->giteEqpInts;
    }

    public function addGiteEqpInt(GiteEqpInt $giteEqpInt): self
    {
        if (!$this->giteEqpInts->contains($giteEqpInt)) {
            $this->giteEqpInts->add($giteEqpInt);
            $giteEqpInt->setEqpInt($this);
        }

        return $this;
    }

    public function removeGiteEqpInt(GiteEqpInt $giteEqpInt): self
    {
        if ($this->giteEqpInts->removeElement($giteEqpInt)) {
            // set the owning side to null (unless already changed)
            if ($giteEqpInt->getEqpInt() === $this) {
                $giteEqpInt->setEqpInt(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
