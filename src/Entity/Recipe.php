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
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="productedBy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

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

    public function toJson(int $depth = -1)
    {
        $itemJson = [];
        if ($depth > 0 && $depth != -1) {
            $itemJson = $this->getItem()->toJson();
        }
        return [
            'id' => $this->getId(),
            'count' => $this->getCount(),
            'item' => $itemJson,
        ];
    }

    public function getProduct(): ?Item
    {
        return $this->product;
    }

    public function setProduct(?Item $product): self
    {
        $this->product = $product;

        return $this;
    }
}
