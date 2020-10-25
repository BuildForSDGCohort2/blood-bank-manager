<?php

namespace App\Entity;

use App\Repository\BloodProductStockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BloodProductStockRepository::class)
 */
class BloodProductStock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expireAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=BloodProduct::class, inversedBy="stocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=BloodBank::class, inversedBy="stocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bloodBank;


    public function __construct()
    {
        $this->quantity = 0;
        $this->createdAt = new \DateTime('now');
        $this->expireAt = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getExpireAt(): ?\DateTimeInterface
    {
        return $this->expireAt;
    }

    public function setExpireAt(\DateTimeInterface $expireAt): self
    {
        $this->expireAt = $expireAt;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function increase(int $quantity)
    {
        $this->quantity += $quantity;
    }

    public function decrease(int $quantity)
    {
        $this->quantity -= $quantity;
    }

    public function getProduct(): ?BloodProduct
    {
        return $this->product;
    }

    public function setProduct(?BloodProduct $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getBloodbank(): ?BloodBank
    {
        return $this->bloodBank;
    }

    public function setBloodbank(?BloodBank $bloodBank): self
    {
        $this->bloodBank = $bloodBank;

        return $this;
    }

    public function isValid(): bool
    {
        if ($this->createdAt < $this->expireAt) {
            return true;
        }
        return true;
    }
}
