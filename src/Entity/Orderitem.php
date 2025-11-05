<?php

namespace App\Entity;

use App\Repository\OrderitemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderitemRepository::class)]
class Orderitem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $orderid = null;

    #[ORM\Column(length: 255)]
    private ?string $producttype = null;

    #[ORM\Column]
    private ?int $productid = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    public function setOrderid(int $orderid): static
    {
        $this->orderid = $orderid;

        return $this;
    }

    public function getProducttype(): ?string
    {
        return $this->producttype;
    }

    public function setProducttype(string $producttype): static
    {
        $this->producttype = $producttype;

        return $this;
    }

    public function getProductid(): ?int
    {
        return $this->productid;
    }

    public function setProductid(int $productid): static
    {
        $this->productid = $productid;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

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
}
