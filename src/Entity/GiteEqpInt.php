<?php

namespace App\Entity;

use App\Repository\GiteEqpIntRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GiteEqpIntRepository::class)]
class GiteEqpInt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'giteEqpInts', cascade: ['persist'])]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?Gite $gite = null;

    #[ORM\ManyToOne(inversedBy: 'giteEqpInts', cascade: ['persist'])]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?EqpInt $eqpInt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGite(): ?Gite
    {
        return $this->gite;
    }

    public function setGite(?Gite $gite): self
    {
        $this->gite = $gite;

        return $this;
    }

    public function getEqpInt(): ?EqpInt
    {
        return $this->eqpInt;
    }

    public function setEqpInt(?EqpInt $eqpInt): self
    {
        $this->eqpInt = $eqpInt;

        return $this;
    }
    
}
