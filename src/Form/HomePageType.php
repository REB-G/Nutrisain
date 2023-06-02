<?php

namespace App\Form;

use App\Entity\HomePage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HomePageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'row_attr' => [
                    'class' => 'home-page-form__field'
                ],
                'label' => 'Titre de la page',
                'label_attr' => [
                    'class' => 'home-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'home-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre de la page Contact.',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le titre de la page doit être de 2 caractères minimum.',
                        'max' => 255,
                        'maxMessage' => 'Le titre de la page ne doit pas dépasser 255 caractères',
                    ]),
                ],
            ])
            ->add('welcomeText', TextareaType::class, [
                'row_attr' => [
                    'class' => 'home-page-form__field'
                ],
                'label' => 'Texte de bienvenue',
                'label_attr' => [
                    'class' => 'home-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'home-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le texte de bienvenue.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le texte de bienvenue doit être de 10 caractères minimum.',
                        'max' => 1255,
                        'maxMessage' => 'Le texte de bienvenue ne doit pas dépasser 1255 caractères',
                    ]),
                ],
            ])
            ->add('aboutTitle', TextType::class, [
                'row_attr' => [
                    'class' => 'home-page-form__field'
                ],
                'label' => 'Titre de la section "A propos"',
                'label_attr' => [
                    'class' => 'home-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'home-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre de la section "À propos".',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le titre de la section "À propos" doit être de 2 caractères minimum.',
                        'max' => 255,
                        'maxMessage' => 'Le titre de la section "À propos" ne doit pas dépasser 255 caractères',
                    ]),
                ],
            ])
            ->add('aboutText', TextareaType::class, [
                'row_attr' => [
                    'class' => 'home-page-form__field'
                ],
                'label' => 'Texte de la section "A propos"',
                'label_attr' => [
                    'class' => 'home-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'home-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le texte de la section "À propos".',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le texte de la section "À propos" doit être de 10 caractères minimum.',
                        'max' => 1255,
                        'maxMessage' => 'Le texte de la section "À propos" ne doit pas dépasser 1255 caractères',
                    ]),
                ],
            ])
            ->add('servicesTitle', TextType::class, [
                'row_attr' => [
                    'class' => 'home-page-form__field'
                ],
                'label' => 'Titre de la section "Nos services"',
                'label_attr' => [
                    'class' => 'home-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'home-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre de la section "Nos services".',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le titre de la section "Nos services" doit être de 2 caractères minimum.',
                        'max' => 255,
                        'maxMessage' => 'Le titre de la section "Nos services" ne doit pas dépasser 255 caractères',
                    ]),
                ],
            ])
            ->add('servicesText', TextareaType::class, [
                'row_attr' => [
                    'class' => 'home-page-form__field'
                ],
                'label' => 'Texte de présentation de la section "Nos servcies"',
                'label_attr' => [
                    'class' => 'home-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'home-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le texte de la section "Nos services".',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le texte de la section "Nos services" doit être de 10 caractères minimum.',
                        'max' => 1255,
                        'maxMessage' => 'Le texte de la section "Nos services" ne doit pas dépasser 1255 caractères',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HomePage::class,
        ]);
    }
}
