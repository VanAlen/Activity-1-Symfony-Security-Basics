<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Entity\Customjewelries;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 100)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    // 🔹 Add relation to Customjewelries
    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Customjewelries::class, orphanRemoval: true)]
    private Collection $customjewelries;

    public function __construct()
    {
        $this->customjewelries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username ?? '';
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password ?? '';
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER'; // every user has at least ROLE_USER
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    // Required by UserInterface
    public function eraseCredentials(): void
    {
        // If you store temporary sensitive data, clear it here
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->username;
    }

    // 🔹 Relation accessors

    /**
     * @return Collection<int, Customjewelries>
     */
    public function getCustomjewelries(): Collection
    {
        return $this->customjewelries;
    }

    public function addCustomjewelry(Customjewelries $customjewelry): static
    {
        if (!$this->customjewelries->contains($customjewelry)) {
            $this->customjewelries->add($customjewelry);
            $customjewelry->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomjewelry(Customjewelries $customjewelry): static
    {
        if ($this->customjewelries->removeElement($customjewelry)) {
            if ($customjewelry->getCustomer() === $this) {
                $customjewelry->setCustomer(null);
            }
        }

        return $this;
    }
}
