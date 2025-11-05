<?php

namespace App\Entity;

use App\Repository\JewelriesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Gemtype;
#[ORM\Entity(repositoryClass: JewelriesRepository::class)]
class Jewelries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Gemtype::class)]
    #[ORM\JoinColumn(name: 'gemtype_id', referencedColumnName: 'id', nullable: true)]
    private ?Gemtype $gemtype = null;

    

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\ManyToOne(targetEntity: Jewelrytype::class, inversedBy: 'jewelries')]
    #[ORM\JoinColumn(name: 'jewelrytype_id', referencedColumnName: 'id', nullable: true)]
    private ?Jewelrytype $jewelrytype = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

public function getGemtype(): ?Gemtype
{
    return $this->gemtype;
}

public function setGemtype(?Gemtype $gemtype): static
{
    $this->gemtype = $gemtype;
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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getJewelrytype(): ?Jewelrytype
    {
        return $this->jewelrytype;
    }

    public function setJewelrytype(?Jewelrytype $jewelrytype): static
    {
        $this->jewelrytype = $jewelrytype;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
