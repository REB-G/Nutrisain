<?php

namespace App\Form;

use App\Entity\Diets;
use App\Entity\Recipes;
use App\Entity\Allergies;
use App\Entity\Categories;
use App\Entity\Difficulties;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Regex;

class RecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Titre de la recette',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre de la recette.',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le titre de la recette doit être de 2 caractères minimum.',
                        'max' => 255,
                        'maxMessage' => 'Le titre de la recette ne doit pas dépasser 255 caractères',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Description de la recette',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la description de la recette.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'La description de la recette doit être de 10 caractères minimum.',
                        'max' => 1255,
                        'maxMessage' => 'La description de la recette ne doit pas dépasser 1255 caractères',
                    ]),
                ],
            ])
            ->add('preparationTime', IntegerType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Temps de préparation (en minutes)',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le temps de préparation de la recette.',
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le temps de préparation de la recette doit être de 1 caractère minimum.',
                        'max' => 3,
                        'maxMessage' => 'Le temps de préparation de la recette ne doit pas dépasser 3 caractères',
                    ]),
                    new PositiveOrZero([
                        'message' => 'Le temps de préparation de la recette doit être un nombre positif.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]+$/',
                        'message' => 'Le temps de préparation de la recette ne doit contenir que des chiffres.',
                    ]),
                ],
            ])
            ->add('preparationStandingTime', IntegerType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Temps de repos (en minutes)',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le temps de repos de la recette.',
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le temps de repos de la recette doit être de 1 caractère minimum.',
                        'max' => 4,
                        'maxMessage' => 'Le temps de repos de la recette ne doit pas dépasser 4 caractères',
                    ]),
                    new PositiveOrZero([
                        'message' => 'Le temps de repos de la recette doit être un nombre positif.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]+$/',
                        'message' => 'Le temps de repos de la recette ne doit contenir que des chiffres.',
                    ]),
                ],
            ])
            ->add('cookingTime', IntegerType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Temps de cuisson (en minutes)',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le temps de cuisson de la recette.',
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le temps de cuisson de la recette doit être de 1 caractère minimum.',
                        'max' => 3,
                        'maxMessage' => 'Le temps de cuisson de la recette ne doit pas dépasser 3 caractères',
                    ]),
                    new PositiveOrZero([
                        'message' => 'Le temps de cuisson de la recette doit être un nombre positif.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]+$/',
                        'message' => 'Le temps de cuisson de la recette ne doit contenir que des chiffres.',
                    ]),
                ],
            ])
            ->add('ingredients', TextareaType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Ingrédients',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner les ingrédients de la recette.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Les ingrédients de la recette doivent être de 3 caractères minimum.',
                        'max' => 1255,
                        'maxMessage' => 'Les ingrédients de la recette ne doivent pas dépasser 1255 caractères',
                    ]),
                ],
            ])
            ->add('stagesOfRecipe', TextareaType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Etapes de la recette',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner les étapes de la recette.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Les étapes de la recette doivent être de 3 caractères minimum.',
                        'max' => 1255,
                        'maxMessage' => 'Les étapes de la recette ne doivent pas dépasser 1255 caractères',
                    ]),
                ],
            ])
            ->add('isPublic', CheckboxType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field recipe-form__field--ispublic-checkbox'
                ],
                'label' => 'La recette est-elle publique ?',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'required' => false,
            ])
            ->add('imageFile', VichImageType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Image du plat',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ],
                'required' => false,
            ])
            ->add('imageName', TextType::class, [
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Nom de l\'image de la recette',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Categories::class,
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Catégorie de la recette',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ]
            ])
            ->add('difficulty', EntityType::class, [
                'class' => Difficulties::class,
                'row_attr' => [
                    'class' => 'recipe-form__field'
                ],
                'label' => 'Difficulté de la recette',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
                'attr' => [
                    'class' => 'recipe-form__field--input',
                ]
            ])
            ->add('allergy', EntityType::class, [
                'class' => Allergies::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Allergies',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
            ])
            ->add('diet', EntityType::class, [
                'class' => Diets::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Régimes',
                'label_attr' => [
                    'class' => 'recipe-form__field--label'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
