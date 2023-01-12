<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Gite::class)]
    private Collection $gite;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Gite::class)]
    private Collection $giteContact;

    public function __construct()
    {
        $this->gite = new ArrayCollection();
        $this->giteContact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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
            $gite->setUser($this);
        }

        return $this;
    }

    public function removeGite(Gite $gite): self
    {
        if ($this->gite->removeElement($gite)) {
            // set the owning side to null (unless already changed)
            if ($gite->getUser() === $this) {
                $gite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Gite>
     */
    public function getGiteContact(): Collection
    {
        return $this->giteContact;
    }

    public function addGiteContact(Gite $giteContact): self
    {
        if (!$this->giteContact->contains($giteContact)) {
            $this->giteContact->add($giteContact);
            $giteContact->setContact($this);
        }

        return $this;
    }

    public function removeGiteContact(Gite $giteContact): self
    {
        if ($this->giteContact->removeElement($giteContact)) {
            // set the owning side to null (unless already changed)
            if ($giteContact->getContact() === $this) {
                $giteContact->setContact(null);
            }
        }

        return $this;
    }
}
