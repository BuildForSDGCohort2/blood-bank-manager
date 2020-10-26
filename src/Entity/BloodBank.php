<?php

namespace App\Entity;

use App\Repository\BloodBankRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BloodBankRepository::class)
 * @UniqueEntity(fields={"codeName"}, message="There is already an blood bank with this code name")
 */
class BloodBank
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=BloodBankManager::class, mappedBy="bloodBank", orphanRemoval=true)
     */
    private $managers;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\Regex("#^([a-zA-Z0-9]+-?[a-zA-Z0-9]+)+$#")
     * @Assert\Length(min=4, max=50)
     */
    private $codeName;


    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type("bool")
     */
    private $isSetup;


    /**
     * @ORM\OneToMany(targetEntity=BloodProductStock::class, mappedBy="bloodBank", orphanRemoval=true)
     */
    private $stocks;

    /**
     * @ORM\OneToMany(targetEntity=BloodProduct::class, mappedBy="bloodBank", orphanRemoval=true)
     */
    private $products;

    /**
     * @ORM\Column(type="boolean")
     */
    private $indexed;
    
    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="bloodBank", orphanRemoval=true)
     */
    private $orders;

    

    public function __construct()
    {
        $this->managers = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->isSetup = false;
        $this->indexed = true;
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|BloodBankManager[]
     */
    public function getManagers(): Collection
    {
        return $this->managers;
    }

    public function addManager(BloodBankManager $manager): self
    {
        if (!$this->managers->contains($manager)) {
            $this->managers[] = $manager;
            $manager->setBloodBank($this);
        }

        return $this;
    }

    public function removeManager(BloodBankManager $manager): self
    {
        if ($this->managers->contains($manager)) {
            $this->managers->removeElement($manager);
            // set the owning side to null (unless already changed)
            if ($manager->getBloodBank() === $this) {
                $manager->setBloodBank(null);
            }
        }

        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName): self
    {
        $this->codeName = $codeName;

        return $this;
    }

    public function isSetup(): bool
    {
        return $this->isSetup;
    }

    public function setIsSetup(bool $isSetup): self
    {
        $this->isSetup = $isSetup;

        return $this;
    }

    /**
     * @return Collection|BloodProductStock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(BloodProductStock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setBloodbank($this);
        }

        return $this;
    }

    public function removeStock(BloodProductStock $stock): self
    {
        if ($this->stocks->contains($stock)) {
            $this->stocks->removeElement($stock);
            // set the owning side to null (unless already changed)
            if ($stock->getBloodbank() === $this) {
                $stock->setBloodbank(null);
            }
        }

        return $this;
    }

    public function getIsSetup(): ?bool
    {
        return $this->isSetup;
    }

    /**
     * @return Collection|BloodProduct[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(BloodProduct $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setBloodBank($this);
        }

        return $this;
    }

    public function removeProduct(BloodProduct $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getBloodBank() === $this) {
                $product->setBloodBank(null);
            }
        }

        return $this;
    }

    public function isGranted(User $user, string $role): bool
    {
        $exist = $this->managers->exists(function ($key, $element) use ($user, $role) {
            if ($element->getUser() == $user) {
                // retrieve manager roles
                $roles = $element->getRoles();

                // verify if the manager have the required role
                if (in_array($role, $roles)) {
                    return true;
                }
                return false;
            }
        });

        return $exist;

    }
    
    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setBloodBank($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getBloodBank() === $this) {
                $order->setBloodBank(null);
            }
        }

        return $this;
    }

    public function getIndexed(): ?bool
    {
        return $this->indexed;
    }

    public function setIndexed(bool $indexed): self
    {
        $this->indexed = $indexed;

        return $this;
    }

    public function isIndexed(): bool
    {
        return $this->getIndexed();
    }
}
