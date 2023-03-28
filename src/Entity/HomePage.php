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
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le texte de bienvenue.')]
    private ?string $welcomeText = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le titre de la section "À propos".')]
    private ?string $aboutTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le texte de la section "À propos".')]
    private ?string $aboutText = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le titre de la section "Services".')]
    private ?string $servicesTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le texte de la section "Services".')]
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
