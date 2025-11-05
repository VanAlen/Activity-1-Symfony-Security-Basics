<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

#[ORM\Column(type: 'float')]
#[Assert\NotBlank(message: 'Carat is required')]
private ?float $carat = null;

#[ORM\Column(length: 100)]
#[Assert\NotBlank(message: 'Size is required')]
private ?string $size = null;

#[ORM\Column(length: 100)]
#[Assert\NotBlank(message: 'Cut is required')]
private ?string $cut = null;

#[ORM\Column(length: 100)]
#[Assert\NotBlank(message: 'Color is required')]
private ?string $color = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Clarity is required')]
    private ?string $clarity = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Origin is required')]
    private ?string $origin = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Description is required')]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Stock is required')]
    private ?int $stock = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    #[Assert\NotBlank(message: 'Price is required')]
    private ?string $price = null;

    #[ORM\ManyToOne(targetEntity: Gemtype::class, inversedBy: 'products')]
    private ?Gemtype $gemtype = null;



    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imagepath = null;
    // ---------------- GETTERS & SETTERS ---------------- //

    public function getImagepath(): ?string
    {
        return $this->imagepath;
    }

    public function setImagepath(?string $imagepath): self
    {
        $this->imagepath = $imagepath;
        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCarat(): ?float
    {
        return $this->carat;
    }

    public function setCarat(float $carat): static
    {
        $this->carat = $carat;
        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): static
    {
        $this->size = $size;
        return $this;
    }

    public function getCut(): ?string
    {
        return $this->cut;
    }

    public function setCut(string $cut): static
    {
        $this->cut = $cut;
        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;
        return $this;
    }

    public function getClarity(): ?string
    {
        return $this->clarity;
    }

    public function setClarity(string $clarity): static
    {
        $this->clarity = $clarity;
        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): static
    {
        $this->origin = $origin;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;
        return $this;
    }


    public function getGemtype(): ?Gemtype
    {
        return $this->gemtype;
    }

    public function setGemtype(?Gemtype $gemtype): static
    {
        $this->gemtype = $gemtype;

        return $this;
    }

}
