<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClothRepository")
 */
class Cloth
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
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bonus", mappedBy="cloth")
     */
    private $bonuses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="cloth")
     */
    private $items;

    public function __construct()
    {
        $this->bonuses = new ArrayCollection();
        $this->items = new ArrayCollection();
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }


    public function toJson(int $depth = -1)
    {
        $itemsJson = [];
        $bonusJson = [];
        if ($depth > 0 && $depth != -1) {
            --$depth;
            foreach ($this->getItems() as $item) {
                $itemsJson[] = $item->toJson($depth);
            }
            foreach ($this->getBonuses() as $bonus) {
                $count = $bonus->getCount();
                if (!isset($bonusJson[$count])) {
                    $bonusJson[$count] = [];
                }
                $bonusJson[$count][] = $bonus->toJson($depth);
            }
        }
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'level' => $this->getLevel(),
            'items' => $itemsJson,
            'bonuses' => $bonusJson,
        ];
    }

    /**
     * @return Collection|Bonus[]
     */
    public function getBonuses(): Collection
    {
        return $this->bonuses;
    }

    public function addBonus(Bonus $bonus): self
    {
        if (!$this->bonuses->contains($bonus)) {
            $this->bonuses[] = $bonus;
            $bonus->setCloth($this);
        }

        return $this;
    }

    public function removeBonus(Bonus $bonus): self
    {
        if ($this->bonuses->contains($bonus)) {
            $this->bonuses->removeElement($bonus);
            // set the owning side to null (unless already changed)
            if ($bonus->getCloth() === $this) {
                $bonus->setCloth(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setCloth($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getCloth() === $this) {
                $item->setCloth(null);
            }
        }

        return $this;
    }
}
