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
    private $isSetup = false;

    public function __construct()
    {
        $this->managers = new ArrayCollection();
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
}
