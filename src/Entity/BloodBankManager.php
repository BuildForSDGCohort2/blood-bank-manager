<?php

namespace App\Entity;

use App\Repository\BloodBankManagerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BloodBankManagerRepository::class)
 */
class BloodBankManager
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="managedBloodBanks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=BloodBank::class, inversedBy="managers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bloodBank;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
