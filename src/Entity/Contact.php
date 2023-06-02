<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    #[Assert\NotBlank(message: 'Veuillez renseigner un numéro de téléphone.')]
    #[Assert\Length(
        min: 10, max: 10,
        minMessage: 'Le numéro de téléphone doit être de 10 caractères minimum.',
        maxMessage: "Le numéro de téléphone ne doit pas dépasser 10 caractères"
    )]
    #[Assert\Regex(pattern: '/^0[1-9]([-. ]?[0-9]{2}){4}$/', message: 'Le numéro de téléphone ne doit contenir que des chiffres, des espaces et le caractère +.')]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner une adresse.')]
    #[Assert\Length(
        min: 10, max: 255,
        minMessage: 'L\'adresse doit être de 10 caractères minimum.',
        maxMessage: "L\'adresse ne doit pas dépasser 255 caractères"
    )]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner une adresse email.')]
    #[Assert\Email(message: 'L\'email {{ value }} n\'est pas valide.',)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner un titre pour la page contact.')]
    #[Assert\Length(
        min: 2, max: 255,
        minMessage: 'Le titre de la page doit être de 2 caractères minimum.',
        maxMessage: "Le titre de le page ne doit pas dépasser 255 caractères"
    )]
    private ?string $pageTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner un texte pour la page contact.')]
    #[Assert\Length(
        min: 10, max: 1255,
        minMessage: 'Le titre de la page doit être de 10 caractères minimum.',
        maxMessage: "Le nom ne doit pas dépasser 1255 caractères"
    )]
    private ?string $pageText = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPageTitle(): ?string
    {
        return $this->pageTitle;
    }

    public function setPageTitle(string $pageTitle): self
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    public function getPageText(): ?string
    {
        return $this->pageText;
    }

    public function setPageText(string $pageText): self
    {
        $this->pageText = $pageText;

        return $this;
    }
}
