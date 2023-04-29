<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le nom de la catégorie.')]
    #[Assert\Length(
        min: 2, max: 50,
        minMessage: 'Le nom de la catégorie doit être de 2 caractères minimum.',
        maxMessage: "Le nom de la catégorie ne doit pas dépasser 50 caractères"
    )]
    #[Assert\Regex(pattern: '/^[a-zA-ZÀ-ÿ -]+$/', message: 'Le nom de la catégorie ne doit contenir que des lettres.')]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Recipes::class)]
    private Collection $recipe;

    public function __construct()
    {
        $this->recipe = new ArrayCollection();
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

    public function getRecipe(): Collection
    {
        return $this->recipe;
    }

    public function addRecipe(Recipes $recipe): self
    {
        if (!$this->recipe->contains($recipe)) {
            $this->recipe->add($recipe);
            $recipe->setCategory($this);
        }

        return $this;
    }

    public function removeRecipe(Recipes $recipe): self
    {
        if ($this->recipe->removeElement($recipe)) {
            if ($recipe->getCategory() === $this) {
                $recipe->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
