<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Users;
use App\DataFixtures\DietsFixtures;
use App\DataFixtures\AllergiesFixtures;
use App\DataFixtures\RecipesFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public const USER_REFERENCE = 'user';

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setName('Nuttle')
            ->setFirstname('Ursule')
            ->setEmail('nutrisain@gmail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'Nutrisain.1'))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $user = new Users();
            $user->setName($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setEmail($faker->email())
                ->setPassword($this->passwordHasher->hashPassword($user, 'Nutrisain.MotDePasse.1'))
                ->addDiet($this->getReference(DietsFixtures::DIET_REFERENCE))
                ->addAllergy($this->getReference(AllergiesFixtures::ALLERGY_REFERENCE))
                ->addFavoriteRecipe($this->getReference(RecipesFixtures::RECIPE_REFERENCE));
            $this->setReference(SELF::USER_REFERENCE, $user);

            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DietsFixtures::class,
            AllergiesFixtures::class,
            RecipesFixtures::class
        ];
    }
}
