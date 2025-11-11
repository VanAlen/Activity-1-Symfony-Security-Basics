<?php

namespace App\Entity;

use App\Repository\CustomjewelriesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomjewelriesRepository::class)]
class Customjewelries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $gemtype = null;

    #[ORM\Column(length: 255)]
    private ?string $jewelrytype = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $notes = null;

    #[ORM\Column(length: 255)]
    private ?string $imagepath = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'customjewelries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $customer = null;

    // ----- Getters/Setters -----
    public function getId(): ?int { return $this->id; }

    public function getGemtype(): ?string { return $this->gemtype; }
    public function setGemtype(string $gemtype): static { $this->gemtype = $gemtype; return $this; }

    public function getJewelrytype(): ?string { return $this->jewelrytype; }
    public function setJewelrytype(string $jewelrytype): static { $this->jewelrytype = $jewelrytype; return $this; }

    public function getNotes(): ?string { return $this->notes; }
    public function setNotes(string $notes): static { $this->notes = $notes; return $this; }

    public function getImagepath(): ?string { return $this->imagepath; }
    public function setImagepath(?string $imagepath): static { $this->imagepath = $imagepath; return $this; }

    public function getCreatedAt(): ?\DateTimeImmutable { return $this->created_at; }
    public function setCreatedAt(\DateTimeImmutable $created_at): static { $this->created_at = $created_at; return $this; }

    public function getCustomer(): ?User { return $this->customer; }
    public function setCustomer(?User $customer): static { $this->customer = $customer; return $this; }
}
