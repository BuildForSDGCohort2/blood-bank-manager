<?php

namespace App\Entity;

use App\Repository\BloodProductRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BloodProductRepository::class)
 */
class BloodProduct
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
     * @ORM\Column(type="integer")
     */
    private $volume;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $currency = 'USD';

    /**
     * @ORM\ManyToOne(targetEntity=BloodGroup::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $bloodGroup;

    /**
     * @ORM\ManyToOne(targetEntity=BloodProductType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=BloodProductStock::class, mappedBy="product", orphanRemoval=true)
     */
    private $stocks;

    /**
     * @ORM\ManyToOne(targetEntity=BloodBank::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bloodBank;


    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->expiresAt = new \DateTime('now');
        $this->stocks = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->type->getName() . ' (' . $this->getBloodGroup()->getCode() .') ' . $this->volume;
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

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getBloodGroup(): ?BloodGroup
    {
        return $this->bloodGroup;
    }

    public function setBloodGroup(?BloodGroup $bloodGroup): self
    {
        $this->bloodGroup = $bloodGroup;

        return $this;
    }

    public function getType(): ?BloodProductType
    {
        return $this->type;
    }

    public function setType(?BloodProductType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|BloodProductStock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function getAvailableStock(): int
    {
        $availableStock = 0;

        /** @var BloodProductStock $stock */
        foreach ($this->getStocks() as $key => $stock) {
            if ($stock->isValid()) {
                $availableStock += $stock->getQuantity();
            }
        }

        return $availableStock;
    }

    public function addStock(BloodProductStock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setProduct($this);
        }

        return $this;
    }

    public function removeStock(BloodProductStock $stock): self
    {
        if ($this->stocks->contains($stock)) {
            $this->stocks->removeElement($stock);
            // set the owning side to null (unless already changed)
            if ($stock->getProduct() === $this) {
                $stock->setProduct(null);
            }
        }

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
