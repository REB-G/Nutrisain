<?php

namespace App\Entity;

use App\Repository\DietsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DietsRepository::class)]
class Diets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le nom du régime.')]
    #[Assert\Length(
        min: 2, max: 50,
        minMessage: 'Le nom du régime doit être de 2 caractères minimum.',
        maxMessage: "Le nom du régime ne doit pas dépasser 50 caractères"
    )]
    #[Assert\Regex(pattern: '/^[a-zA-ZÀ-ÿ -]+$/', message: 'Le nom du régime ne doit contenir que des lettres.')]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'diet')]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: Recipes::class, mappedBy: 'diet')]
    private Collection $recipe;

    public function __construct()
    {
        $this->user = new ArrayCollection();
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

    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->addDiet($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->user->removeElement($user)) {
            $user->removeDiet($this);
        }

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
            $recipe->addDiet($this);
        }

        return $this;
    }

    public function removeRecipe(Recipes $recipe): self
    {
        if ($this->recipe->removeElement($recipe)) {
            $recipe->removeDiet($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
