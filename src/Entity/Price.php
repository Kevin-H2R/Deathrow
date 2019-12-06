<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="prices")
     * @ORM\JoinColumn(nullable=true)

     */
    private $item;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $unit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tens;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hundreds;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getUnit(): ?int
    {
        return $this->unit;
    }

    public function setUnit(?int $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getTens(): ?int
    {
        return $this->tens;
    }

    public function setTens(?int $tens): self
    {
        $this->tens = $tens;

        return $this;
    }

    public function getHundreds(): ?int
    {
        return $this->hundreds;
    }

    public function setHundreds(?int $hundreds): self
    {
        $this->hundreds = $hundreds;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
