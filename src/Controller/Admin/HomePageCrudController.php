<?php

namespace App\Controller\Admin;

use App\Entity\HomePage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HomePageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomePage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Page d\'accueil')
            ->setDefaultSort(['id' => 'DESC'])
            ->setPageTitle('index', '%entity_label_singular%');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('title', 'Titre de la page'),
            TextareaField::new('welcomeText', 'Texte de bienvenue'),
            TextField::new('AboutTitle', 'Titre de la section "A propos"'),
            TextareaField::new('AboutText', 'Texte de la section "A propos"'),
            TextField::new('ServicesTitle', 'Titre de la section "Nos services"'),
            TextareaField::new('ServicesText', 'Texte de la section "Nos services"'),
        ];
    }
}
