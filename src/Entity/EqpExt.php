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

    #[ORM\OneToMany(mappedBy: 'eqpExt', targetEntity: GiteEqpExt::class, cascade: ['persist'])]
    private Collection $giteEqpExts;

    public function __construct()
    {
        $this->giteEqpExts = new ArrayCollection();
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
     * @return Collection<int, GiteEqpExt>
     */
    public function getGiteEqpExts(): Collection
    {
        return $this->giteEqpExts;
    }

    public function addGiteEqpExt(GiteEqpExt $giteEqpExt): self
    {
        if (!$this->giteEqpExts->contains($giteEqpExt)) {
            $this->giteEqpExts->add($giteEqpExt);
            $giteEqpExt->setEqpExt($this);
        }

        return $this;
    }

    public function removeGiteEqpExt(GiteEqpExt $giteEqpExt): self
    {
        if ($this->giteEqpExts->removeElement($giteEqpExt)) {
            // set the owning side to null (unless already changed)
            if ($giteEqpExt->getEqpExt() === $this) {
                $giteEqpExt->setEqpExt(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
    
}
