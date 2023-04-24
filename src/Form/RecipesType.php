<?php

namespace App\Form;

use App\Entity\Diets;
use App\Entity\Recipes;
use App\Entity\Allergies;
use App\Entity\Categories;
use App\Entity\Difficulties;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
                ]
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
                ]
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
                ]
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
                ]
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
                ]
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
                ]
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
                ]
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
            ->add('imageFile', FileType::class, [
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
                'mapped' => false,
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
