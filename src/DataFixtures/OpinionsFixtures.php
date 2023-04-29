<?php

namespace App\DataFixtures;

use App\Entity\Opinions;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class OpinionsFixtures extends Fixture implements DependentFixtureInterface
{
    public const OPINION_REFERENCE = 'opinion';

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $comment = [
            'Très bon',
            'Bon',
            'Moyen',
            'Pas bon',
            'Très mauvais',
        ];

        for ($i=1; $i <=20; $i++) {
            $opinion = new Opinions();

            $opinion->setComment($faker->randomElement($comment))
                ->setUser($this->getReference(UsersFixtures::USER_REFERENCE))
                ->setUserName($faker->name())
                ->setUserFirstname($faker->firstName())
                ->setRecipe($this->getReference(RecipesFixtures::RECIPE_REFERENCE));
            $this->setReference(SELF::OPINION_REFERENCE, $opinion);

            $manager->persist($opinion);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
            RecipesFixtures::class,
        ];
    }
}
