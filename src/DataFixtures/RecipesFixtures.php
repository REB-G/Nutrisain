<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Recipes;
use App\DataFixtures\DietsFixtures;
use App\DataFixtures\AllergiesFixtures;
use App\DataFixtures\DifficultiesFixtures;
use App\DataFixtures\CategoriesFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RecipesFixtures extends Fixture implements DependentFixtureInterface
{
    public const RECIPE_REFERENCE = 'recipe';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            $recipe = new Recipes();
            $recipe->setTitle($faker->word())
                ->setDescription($faker->text(200))
                ->setPreparationTime($faker->numberBetween(10, 40))
                ->setPreparationStandingTime($faker->numberBetween(10, 90))
                ->setCookingTime($faker->numberBetween(10, 90))
                ->setIngredients($faker->word(5))
                ->setStagesOfRecipe($faker->sentence(5))
                ->setIsPublic($faker->boolean())
                ->setImageFileName('default.jpg')
                ->addDiet($this->getReference(DietsFixtures::DIET_REFERENCE))
                ->addAllergy($this->getReference(AllergiesFixtures::ALLERGY_REFERENCE))
                ->setDifficulty($this->getReference(DifficultiesFixtures::DIFFICULTY_REFERENCE))
                ->setCategory($this->getReference(CategoriesFixtures::CATEGORY_REFERENCE));
            $this->setReference(SELF::RECIPE_REFERENCE, $recipe);

            $manager->persist($recipe);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DietsFixtures::class,
            AllergiesFixtures::class,
            DifficultiesFixtures::class,
            CategoriesFixtures::class,
        ];
    }
}
