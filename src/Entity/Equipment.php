<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipmentRepository")
 */
class Equipment
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Cloth", inversedBy="equipments")
     */
    private $cloth;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe", inversedBy="equipments")
     */
    private $recipes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Effect", mappedBy="equipment")
     */
    private $effects;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $image_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->effects = new ArrayCollection();
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

    public function getCloth(): ?Cloth
    {
        return $this->cloth;
    }

    public function setCloth(?Cloth $cloth): self
    {
        $this->cloth = $cloth;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
        }

        return $this;
    }

    /**
     * @return Collection|Effect[]
     */
    public function getEffects(): Collection
    {
        return $this->effects;
    }

    public function addEffect(Effect $effect): self
    {
        if (!$this->effects->contains($effect)) {
            $this->effects[] = $effect;
            $effect->setEquipment($this);
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        if ($this->effects->contains($effect)) {
            $this->effects->removeElement($effect);
            // set the owning side to null (unless already changed)
            if ($effect->getEquipment() === $this) {
                $effect->setEquipment(null);
            }
        }

        return $this;
    }

    public function getImageId(): ?int
    {
        return $this->image_id;
    }

    public function setImageId(?int $image_id): self
    {
        $this->image_id = $image_id;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function toJson()
    {
        $effectsJson = [];
        $recipesJson = [];
        foreach ($this->getEffects() as $effect) {
            $effectsJson[] = $effect->toJson();
        }

        foreach ($this->getRecipes() as $recipe) {
            $recipesJson[] = $recipe->toJson();
        }

        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'level' => $this->getLevel(),
            'imageId' => $this->getImageId(),
            'cloth' => $this->getCloth()->toJson(),
            'effects' => $effectsJson,
            'recipes' => $recipesJson,
        ];
    }
}
