<?php

namespace App\Entity;

use App\Repository\GiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GiteRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Gite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255)]
    private ?string $departement = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\Column]
    private ?int $surface = null;

    #[ORM\Column]
    private ?int $rooms = null;

    #[ORM\Column]
    private ?int $beds = null;

    #[ORM\Column]
    private ?bool $animalAllowed = null;

    #[ORM\Column(nullable: true)]
    private ?float $animalFee = null;

    #[ORM\Column]
    private ?float $greenPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $redPrice = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startRed = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endRed = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\OneToMany(mappedBy: 'gite', targetEntity: GiteService::class, cascade: ['persist'])]
    private Collection $giteServices;

    #[ORM\ManyToOne(inversedBy: 'gite', cascade: ['persist'])]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'giteContact', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $contact = null;

    #[ORM\OneToMany(mappedBy: 'gite', targetEntity: GiteEqpExt::class, cascade: ['persist'])]
    private Collection $giteEqpExts;

    #[ORM\OneToMany(mappedBy: 'gite', targetEntity: GiteEqpInt::class, cascade: ['persist'])]
    private Collection $giteEqpInts;

    public function __construct()
    {
        $this->giteServices = new ArrayCollection();
        $this->giteEqpExts = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBeds(): ?int
    {
        return $this->beds;
    }

    public function setBeds(int $beds): self
    {
        $this->beds = $beds;

        return $this;
    }

    public function isAnimalAllowed(): ?bool
    {
        return $this->animalAllowed;
    }

    public function setAnimalAllowed(bool $animalAllowed): self
    {
        $this->animalAllowed = $animalAllowed;

        return $this;
    }

    public function getAnimalFee(): ?float
    {
        return $this->animalFee;
    }

    public function setAnimalFee(?float $animalFee): self
    {
        $this->animalFee = $animalFee;

        return $this;
    }

    public function getGreenPrice(): ?float
    {
        return $this->greenPrice;
    }

    public function setGreenPrice(float $greenPrice): self
    {
        $this->greenPrice = $greenPrice;

        return $this;
    }

    public function getRedPrice(): ?float
    {
        return $this->redPrice;
    }

    public function setRedPrice(?float $redPrice): self
    {
        $this->redPrice = $redPrice;

        return $this;
    }

    public function getStartRed(): ?\DateTimeInterface
    {
        return $this->startRed;
    }

    public function setStartRed(?\DateTimeInterface $startRed): self
    {
        $this->startRed = $startRed;

        return $this;
    }

    public function getEndRed(): ?\DateTimeInterface
    {
        return $this->endRed;
    }

    public function setEndRed(?\DateTimeInterface $endRed): self
    {
        $this->endRed = $endRed;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    
    public function setUpdateAt(\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    #[ORM\PostPersist]
    public function setUpdateAtValue(): void
    {
        $this->updateAt = new \DateTimeImmutable();
    }
    /**
     * @return Collection<int, GiteService>
     */
    public function getGiteServices(): Collection
    {
        return $this->giteServices;
    }

    public function addGiteService(GiteService $giteService): self
    {
        if (!$this->giteServices->contains($giteService)) {
            $this->giteServices->add($giteService);
            $giteService->setGite($this);
        }

        return $this;
    }

    public function removeGiteService(GiteService $giteService): self
    {
        if ($this->giteServices->removeElement($giteService)) {
            // set the owning side to null (unless already changed)
            if ($giteService->getGite() === $this) {
                $giteService->setGite(null);
            }
        }

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getContact(): ?User
    {
        return $this->contact;
    }

    public function setContact(?User $contact): self
    {
        $this->contact = $contact;

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
            $giteEqpExt->setGite($this);
        }

        return $this;
    }

    public function removeGiteEqpExt(GiteEqpExt $giteEqpExt): self
    {
        if ($this->giteEqpExts->removeElement($giteEqpExt)) {
            // set the owning side to null (unless already changed)
            if ($giteEqpExt->getGite() === $this) {
                $giteEqpExt->setGite(null);
            }
        }

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
            $giteEqpInt->setGite($this);
        }

        return $this;
    }

    public function removeGiteEqpInt(GiteEqpInt $giteEqpInt): self
    {
        if ($this->giteEqpInts->removeElement($giteEqpInt)) {
            // set the owning side to null (unless already changed)
            if ($giteEqpInt->getGite() === $this) {
                $giteEqpInt->setGite(null);
            }
        }

        return $this;
    }

 
}
