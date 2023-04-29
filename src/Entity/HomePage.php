<?php

namespace App\Entity;

use App\Repository\HomePageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HomePageRepository::class)]
class HomePage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le titre de la page d\'accueil.')]
    #[Assert\Length(
        min: 2, max: 255,
        minMessage: 'Le titre de la page doit être de 2 caractères minimum.',
        maxMessage: "Le titre de la page ne doit pas dépasser 255 caractères"
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le texte de bienvenue.')]
    #[Assert\Length(
        min: 10, max: 1255,
        minMessage: 'Le texte de bienvenue doit être de 10 caractères minimum.',
        maxMessage: "Le texte de bienvenue ne doit pas dépasser 1255 caractères"
    )]
    private ?string $welcomeText = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le titre de la section "À propos".')]
    #[Assert\Length(
        min: 2, max: 255,
        minMessage: 'Le titre de la section \"À propos\" doit être de 2 caractères minimum.',
        maxMessage: "Le titre de la section \"À propos\" ne doit pas dépasser 255 caractères"
    )]
    private ?string $aboutTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le texte de la section "À propos".')]
    #[Assert\Length(
        min: 10, max: 1255,
        minMessage: 'Le texte de la section \"À propos\" doit être de 10 caractères minimum.',
        maxMessage: "Le texte de la section \"À propos\" ne doit pas dépasser 1255 caractères"
    )]
    private ?string $aboutText = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le titre de la section "Services".')]
    #[Assert\Length(
        min: 2, max: 255,
        minMessage: 'Le titre de la section \"Services\" doit être de 2 caractères minimum.',
        maxMessage: "Le titre de la section \"Services\" ne doit pas dépasser 255 caractères"
    )]
    private ?string $servicesTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le texte de la section "Services".')]
    #[Assert\Length(
        min: 10, max: 1255,
        minMessage: 'Le texte de la section \"Services\" doit être de 10 caractères minimum.',
        maxMessage: "Le texte de la section \"Services\" ne doit pas dépasser 1255 caractères"
    )]
    private ?string $servicesText = null;

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

    public function getWelcomeText(): ?string
    {
        return $this->welcomeText;
    }

    public function setWelcomeText(string $welcomeText): self
    {
        $this->welcomeText = $welcomeText;

        return $this;
    }

    public function getAboutTitle(): ?string
    {
        return $this->aboutTitle;
    }

    public function setAboutTitle(string $aboutTitle): self
    {
        $this->aboutTitle = $aboutTitle;

        return $this;
    }

    public function getAboutText(): ?string
    {
        return $this->aboutText;
    }

    public function setAboutText(string $aboutText): self
    {
        $this->aboutText = $aboutText;

        return $this;
    }

    public function getServicesTitle(): ?string
    {
        return $this->servicesTitle;
    }

    public function setServicesTitle(string $servicesTitle): self
    {
        $this->servicesTitle = $servicesTitle;

        return $this;
    }

    public function getServicesText(): ?string
    {
        return $this->servicesText;
    }

    public function setServicesText(string $servicesText): self
    {
        $this->servicesText = $servicesText;

        return $this;
    }
}
