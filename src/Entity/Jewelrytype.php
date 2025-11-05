<?php

namespace App\Entity;

use App\Repository\JewelrytypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Jewelries;

#[ORM\Entity(repositoryClass: JewelrytypeRepository::class)]
class Jewelrytype
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Jewelries>
     */
    #[ORM\OneToMany(mappedBy: 'jewelrytype', targetEntity: Jewelries::class)]
    private Collection $jewelries;

    public function __construct()
    {
        $this->jewelries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection<int, Jewelries>
     */
    public function getJewelries(): Collection
    {
        return $this->jewelries;
    }

    public function addJewelry(Jewelries $jewelry): static
    {
        if (!$this->jewelries->contains($jewelry)) {
            $this->jewelries->add($jewelry);
            $jewelry->setJewelrytype($this);
        }

        return $this;
    }

    public function removeJewelry(Jewelries $jewelry): static
    {
        if ($this->jewelries->removeElement($jewelry)) {
            if ($jewelry->getJewelrytype() === $this) {
                $jewelry->setJewelrytype(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }
}
