<?php

namespace App\Controller\Admin;

use App\Entity\Recipes;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class RecipesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipes::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Recette')
            ->setEntityLabelInPlural('Recettes')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setPaginatorPageSize(10)
            ->setDefaultSort(['id' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('title', 'Titre de la recette'),
            TextAreaField::new('description', 'Description de la recette'),
            IntegerField::new('preparationTime', 'Temps de préparation'),
            IntegerField::new('preparationStandingTime', 'Temps de repos'),
            IntegerField::new('cookingTime', 'Temps de cuisson'),
            TextAreaField::new('ingredients', 'Ingrédients'),
            TextAreaField::new('stagesOfRecipe', 'Etapes de la recette'),
            BooleanField::new('isPublic', 'Recette publique'),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class),
            ImageField::new('imageName', 'Image de la recette')
                ->setBasePath('/uploads/recipes')
                ->onlyOnIndex(),
            DateTimeField::new('createdAt', 'Créé le')
                ->setFormTypeOption('disabled', true),
            DateTimeField::new('updatedAt', 'Modifié le'),
            AssociationField::new('difficulty', 'Niveau de difficulté'),
            AssociationField::new('category', 'Catégorie'),
            AssociationField::new('allergy', 'Allergie'),
            AssociationFIeld::new('diet', 'Régime'),
        ];
    }
}
