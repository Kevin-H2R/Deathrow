<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EffectRepository")
 */
class Effect
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $min;

    /**
     * @ORM\Column(type="smallint")
     */
    private $max;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDamage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="effects")
     */
    private $item;

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

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function toJson(int $depth = -1)
    {
        return  [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'min' => $this->getMin(),
            'max' => $this->getMax(),
            'isDamage' => $this->getIsDamage(),
        ];
    }

    public function getIsDamage(): ?bool
    {
        return $this->isDamage;
    }

    public function setIsDamage(bool $isDamage): self
    {
        $this->isDamage = $isDamage;

        return $this;
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
}
