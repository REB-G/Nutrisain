<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecipesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecipesRepository::class)]
#[Vich\Uploadable]
class Recipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le titre de la recette.')]
    #[Assert\Length(max: 255, maxMessage: "Le nom ne doit pas dépasser 255 caractères")]
    #[Assert\Regex(pattern: "/^[a-zA-ZÀ-ÿ -]+$/", message: "Le nom ne doit contenir que des lettres")]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner la description de la recette.')]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez renseigner le temps de préparation de la recette.')]
    private ?int $preparationTime = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez renseigner le temps de repos de la recette.')]
    private ?int $preparationStandingTime = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez renseigner le temps de cuisson de la recette.')]
    private ?int $cookingTime = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner les ingrédients de la recette.')]
    private ?string $ingredients = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner les étapes de la recette.')]
    private ?string $stagesOfRecipe = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez indiquer si la recette est public ou non.')]
    private ?bool $isPublic = null;

    #[Vich\UploadableField(mapping: 'dishes_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255)]
    private ?string $imageName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Opinions::class, orphanRemoval: true)]
    private Collection $opinion;

    #[ORM\ManyToOne(inversedBy: 'recipe')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $category = null;

    #[ORM\ManyToOne(inversedBy: 'recipe')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Difficulties $difficulty = null;

    #[ORM\ManyToMany(targetEntity: Allergies::class, inversedBy: 'recipe')]
    private Collection $allergy;

    #[ORM\ManyToMany(targetEntity: Diets::class, inversedBy: 'recipe')]
    private Collection $diet;

    public function __construct()
    {
        $this->opinion = new ArrayCollection();
        $this->allergy = new ArrayCollection();
        $this->diet = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(int $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getPreparationStandingTime(): ?int
    {
        return $this->preparationStandingTime;
    }

    public function setPreparationStandingTime(int $preparationStandingTime): self
    {
        $this->preparationStandingTime = $preparationStandingTime;

        return $this;
    }

    public function getCookingTime(): ?int
    {
        return $this->cookingTime;
    }

    public function setCookingTime(int $cookingTime): self
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getStagesOfRecipe(): ?string
    {
        return $this->stagesOfRecipe;
    }

    public function setStagesOfRecipe(string $stagesOfRecipe): self
    {
        $this->stagesOfRecipe = $stagesOfRecipe;

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile($imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getOpinion(): Collection
    {
        return $this->opinion;
    }

    public function addOpinion(Opinions $opinion): self
    {
        if (!$this->opinion->contains($opinion)) {
            $this->opinion->add($opinion);
            $opinion->setRecipe($this);
        }

        return $this;
    }

    public function removeOpinion(Opinions $opinion): self
    {
        if ($this->opinion->removeElement($opinion)) {
            // set the owning side to null (unless already changed)
            if ($opinion->getRecipe() === $this) {
                $opinion->setRecipe(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDifficulty(): ?Difficulties
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulties $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getAllergy(): Collection
    {
        return $this->allergy;
    }

    public function addAllergy(Allergies $allergy): self
    {
        if (!$this->allergy->contains($allergy)) {
            $this->allergy->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(Allergies $allergy): self
    {
        $this->allergy->removeElement($allergy);

        return $this;
    }

    public function getDiet(): Collection
    {
        return $this->diet;
    }

    public function addDiet(Diets $diet): self
    {
        if (!$this->diet->contains($diet)) {
            $this->diet->add($diet);
        }

        return $this;
    }

    public function removeDiet(Diets $diet): self
    {
        $this->diet->removeElement($diet);

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
