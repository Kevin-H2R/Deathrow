<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 * @ORM\Table(
 *     name="recipe",
 *     uniqueConstraints={
 *       @ORM\UniqueConstraint(name="unique_recipe", columns={"item_id", "count"})
 *     }
 * )
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Equipment", mappedBy="recipes")
     */
    private $equipments;

    public function __construct()
    {
        $this->equipments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @return Collection|Equipment[]
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments[] = $equipment;
            $equipment->addRecipe($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipments->contains($equipment)) {
            $this->equipments->removeElement($equipment);
            $equipment->removeRecipe($this);
        }

        return $this;
    }

    public function toJson()
    {
        return [
            'id' => $this->getId(),
            'count' => $this->getCount(),
            'item' => $this->getItem()->toJson(),
        ];
    }
}
