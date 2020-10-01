<?php

namespace App\Entity;

use App\Utils\BloodBankRoles;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BloodBankManagerRepository;

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

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

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

    public function getRoles(): ?array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_MANAGER
        $roles[] = BloodBankRoles::MANAGER;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
