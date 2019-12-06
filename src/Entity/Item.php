<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 * @ORM\Table(name="item", uniqueConstraints={@UniqueConstraint(name="u_item_name", columns={"name"})})
 */
class Item
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
     * @ORM\OneToMany(targetEntity="App\Entity\Recipe", mappedBy="item")
     */
    private $recipes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $image_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Price", mappedBy="item")
     */
    private $prices;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cloth", inversedBy="items")
     */
    private $cloth;

    /**
     * @ORM\Column(type="smallint")
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $pa_cost;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $po_range;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $cc_bonus;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $cc_rate;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $cc_hits;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $hits_count;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $hits_lines;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Constraint", mappedBy="item")
     */
    private $constraints;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Effect", mappedBy="item")
     */
    private $effects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recipe", mappedBy="product")
     */
    private $productedBy;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->constraints = new ArrayCollection();
        $this->effects = new ArrayCollection();
        $this->productedBy = new ArrayCollection();
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
            $recipe->setItem($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            // set the owning side to null (unless already changed)
            if ($recipe->getItem() === $this) {
                $recipe->setItem(null);
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

    public function toJson()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'image' => $this->getImageId(),
        ];
    }

    /**
     * @return Collection|Price[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setItem($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
            // set the owning side to null (unless already changed)
            if ($price->getItem() === $this) {
                $price->setItem(null);
            }
        }

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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

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

    public function getPaCost(): ?int
    {
        return $this->pa_cost;
    }

    public function setPaCost(?int $pa_cost): self
    {
        $this->pa_cost = $pa_cost;

        return $this;
    }

    public function getPoRange(): ?string
    {
        return $this->po_range;
    }

    public function setPoRange(?string $po_range): self
    {
        $this->po_range = $po_range;

        return $this;
    }

    public function getCcBonus(): ?int
    {
        return $this->cc_bonus;
    }

    public function setCcBonus(?int $cc_bonus): self
    {
        $this->cc_bonus = $cc_bonus;

        return $this;
    }

    public function getCcRate(): ?int
    {
        return $this->cc_rate;
    }

    public function setCcRate(?int $cc_rate): self
    {
        $this->cc_rate = $cc_rate;

        return $this;
    }

    public function getCcHits(): ?int
    {
        return $this->cc_hits;
    }

    public function setCcHits(?int $cc_hits): self
    {
        $this->cc_hits = $cc_hits;

        return $this;
    }

    public function getHitsCount(): ?int
    {
        return $this->hits_count;
    }

    public function setHitsCount(?int $hits_count): self
    {
        $this->hits_count = $hits_count;

        return $this;
    }

    public function getHitsLines(): ?int
    {
        return $this->hits_lines;
    }

    public function setHitsLines(?int $hits_lines): self
    {
        $this->hits_lines = $hits_lines;

        return $this;
    }

    /**
     * @return Collection|Constraint[]
     */
    public function getConstraints(): Collection
    {
        return $this->constraints;
    }

    public function addConstraint(Constraint $constraint): self
    {
        if (!$this->constraints->contains($constraint)) {
            $this->constraints[] = $constraint;
            $constraint->setItem($this);
        }

        return $this;
    }

    public function removeConstraint(Constraint $constraint): self
    {
        if ($this->constraints->contains($constraint)) {
            $this->constraints->removeElement($constraint);
            // set the owning side to null (unless already changed)
            if ($constraint->getItem() === $this) {
                $constraint->setItem(null);
            }
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
            $effect->setItem($this);
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        if ($this->effects->contains($effect)) {
            $this->effects->removeElement($effect);
            // set the owning side to null (unless already changed)
            if ($effect->getItem() === $this) {
                $effect->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getProductedBy(): Collection
    {
        return $this->productedBy;
    }

    public function addProductedBy(Recipe $productedBy): self
    {
        if (!$this->productedBy->contains($productedBy)) {
            $this->productedBy[] = $productedBy;
            $productedBy->setProduct($this);
        }

        return $this;
    }

    public function removeProductedBy(Recipe $productedBy): self
    {
        if ($this->productedBy->contains($productedBy)) {
            $this->productedBy->removeElement($productedBy);
            // set the owning side to null (unless already changed)
            if ($productedBy->getProduct() === $this) {
                $productedBy->setProduct(null);
            }
        }

        return $this;
    }
}
