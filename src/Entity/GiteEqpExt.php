<?php

namespace App\Entity;

use App\Repository\GiteEqpExtRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GiteEqpExtRepository::class)]
class GiteEqpExt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'giteEqpExts', cascade: ['persist'])]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?Gite $gite = null;

    #[ORM\ManyToOne(inversedBy: 'giteEqpExts', cascade: ['persist'])]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?EqpExt $eqpExt = null;

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

    public function getEqpExt(): ?EqpExt
    {
        return $this->eqpExt;
    }

    public function setEqpExt(?EqpExt $eqpExt): self
    {
        $this->eqpExt = $eqpExt;

        return $this;
    }

 
    
}
