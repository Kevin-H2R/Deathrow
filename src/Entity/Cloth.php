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
     * @ORM\OneToMany(targetEntity="App\Entity\Equipment", mappedBy="cloth")
     * @Groups({"cloth"})
     */
    private $equipments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bonus", mappedBy="cloth")
     */
    private $bonuses;

    public function __construct()
    {
        $this->equipments = new ArrayCollection();
        $this->bonuses = new ArrayCollection();
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
            $equipment->setCloth($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipments->contains($equipment)) {
            $this->equipments->removeElement($equipment);
            // set the owning side to null (unless already changed)
            if ($equipment->getCloth() === $this) {
                $equipment->setCloth(null);
            }
        }

        return $this;
    }

    public function toJson(int $depth = -1)
    {
        $equipmentsJson = [];
        if ($depth > 0 && $depth != -1) {
            --$depth;
            foreach ($this->getEquipments() as $equipment) {
                $equipmentsJson[] = $equipment->toJson($depth);
            }
        }
        return [
           'id' => $this->getId(),
           'name' => $this->getName(),
           'level' => $this->getLevel(),
            'equipments' => $equipmentsJson,
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
}
