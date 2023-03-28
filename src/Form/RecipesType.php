<?php

namespace App\Form;

use App\Entity\Recipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('preparationTime')
            ->add('preparationStandingTime')
            ->add('cookingTime')
            ->add('ingredients')
            ->add('stagesOfRecipe')
            ->add('isPublic')
            ->add('imageFileName')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('category')
            ->add('difficulty')
            ->add('allergy')
            ->add('diet')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
