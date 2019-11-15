<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BonusRepository")
 */
class Bonus
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
    private $count;

    /**
     * @ORM\Column(type="smallint")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cloth", inversedBy="bonuses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cloth;

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

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCloth(): ?Cloth
    {
        return $this->cloth;
    }

    public function setCloth(?Cloth $cloth): self
    {
        $this->cloth = $cloth;

        return $this;
    }
}
