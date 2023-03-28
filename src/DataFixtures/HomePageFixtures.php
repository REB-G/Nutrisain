<?php

namespace App\DataFixtures;

use App\Entity\HomePage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HomePageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $title = [
            'Bienvenue chez Nutrisain !'
        ];

        $welcomeText = [
            'Ici vous découvrirez comment manger sain et bon pour vous sentir bien !'
        ];

        $aboutTitle = [
            'A propos de Nutrisain'
        ];

        $aboutText = [
            'Nutrisain est une société créée par moi-même: Ursule Nuttle, diététicienne.
            Je suis diplômée de l\'école de diététique de Paris et j\'ai travaillé pendant 10 ans dans un centre de diététique.
            J\'ai ouvert mon cabinet à Caen il y a plusieurs années et j\'effectue des consultations individuelles, des conférences et des ateliers culinaires.
            Les consultations sont également possibles à distance.
            J\'ai décidé de créer mon propre site pour proposer des recettes simples et rapides à réaliser pour permettre à tous de manger sainement au quotidien.
            Chaque patient à des besoins différents et je propose des recettes adaptées aux besoins de chacun.'
        ];

        $servicesTitle = [
            'Nos services'
        ];

        $servicesText = [
            'Je propose des consultations individuelles pour vous aider mes patients à atteindre leurs objectifs.
            J\'effectue également des conférences et des ateliers culinaires pour les entreprises et les associations.
            Je suis également disponible pour des consultations à distance.
            Chaque patient à un suivit personnalisé et des recettes adaptées à ses besoins.
            Sur ce site vous trouverez des recettes, des conseils et des astuces pour manger sainement et pour tous les goûts !'
        ];

        for ($i=1; $i <=1; $i++) {
            $page = new HomePage();
            $page->setTitle($title[$i-1])
                ->setWelcomeText($welcomeText[$i-1])
                ->setAboutTitle($aboutTitle[$i-1])
                ->setAboutText($aboutText[$i-1])
                ->setServicesTitle($servicesTitle[$i-1])
                ->setServicesText($servicesText[$i-1]);

            $manager->persist($page);
        }

        $manager->flush();
    }
}
