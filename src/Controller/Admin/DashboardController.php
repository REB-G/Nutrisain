<?php

namespace App\Controller\Admin;

use App\Entity\Allergies;
use App\Entity\Categories;
use App\Entity\Contact;
use App\Entity\Difficulties;
use App\Entity\Diets;
use App\Entity\HomePage;
use App\Entity\Opinions;
use App\Entity\Recipes;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Nutrisain - Administration')
            ->setFaviconPath("{{asset('build/images/logo_icon.ico')}}")
            ->renderContentMaximized();

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Patients', 'fas fa-list', Users::class);
        yield MenuItem::linkToCrud('Page d\'accueil', 'fas fa-list', HomePage::class);
        yield MenuItem::linkToCrud('Page contact', 'fas fa-list', Contact::class);
        yield MenuItem::linkToCrud('Allergies', 'fas fa-list', Allergies::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('Régimes', 'fas fa-list', Diets::class);
        yield MenuItem::linkToCrud('Niveaux de difficulté', 'fas fa-list', Difficulties::class);
        yield MenuItem::linkToCrud('Recettes', 'fas fa-list', Recipes::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-list', Opinions::class);
        yield MenuItem::linkToRoute('Retour au site', 'fas fa-home', 'app_home_page_index');
        yield MenuItem::linkToLogout('Se déconnecter', 'fa fa-exit');
    }
}
