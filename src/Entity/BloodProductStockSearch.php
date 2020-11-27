<?php

namespace App\Entity;


class BloodProductStockSearch
{
    private int $typeId;

    private string $bloodGroup;

    private int $quantity;

    private int $volume;

    private \DateTime $datetime;


    public function __construct()
    {
        $this->datetime = new \DateTime('now');
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }

    public function getBloodGroup()
    {
        return $this->bloodGroup;
    }

    public function setBloodGroup($bloodGroup): self
    {
        $this->bloodGroup = $bloodGroup;

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

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getDatetime(): ?\DateTime
    {
        return $this->datetime;
    }

    public function setDatetime(\Datetime $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }
}
 