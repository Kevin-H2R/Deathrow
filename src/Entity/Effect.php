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
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipment", inversedBy="effects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDamage;

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

    public function getEquipment(): ?Equipment
    {
        return $this->equipment;
    }

    public function setEquipment(?Equipment $equipment): self
    {
        $this->equipment = $equipment;

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
}
