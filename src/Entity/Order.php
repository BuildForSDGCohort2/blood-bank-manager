<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
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
     * @ORM\OneToMany(targetEntity=BloodProductOrder::class, mappedBy="order", orphanRemoval=true, cascade={"persist"})
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=OrderStatus::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=BloodBank::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bloodBank;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->products = new ArrayCollection();
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

    /**
     * @return Collection|BloodProductOrder[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(BloodProductOrder $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setOrder($this);
        }

        return $this;
    }

    public function removeProduct(BloodProductOrder $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getOrder() === $this) {
                $product->setOrder(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(?OrderStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBloodBank(): ?BloodBank
    {
        return $this->bloodBank;
    }

    public function setBloodBank(?BloodBank $bloodBank): self
    {
        $this->bloodBank = $bloodBank;

        return $this;
    }
}
