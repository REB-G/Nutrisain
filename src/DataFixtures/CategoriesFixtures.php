<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoriesFixtures extends Fixture
{
    public const CATEGORY_REFERENCE = 'category';

    public function load(ObjectManager $manager): void
    {
        $names = [
            'Entrée',
            'Plat',
            'Dessert',
        ];

        for ($i=1; $i <= 3 ; $i++) {
            $category = new Categories();

            $category->setName($names[$i-1]);
            $this->setReference(SELF::CATEGORY_REFERENCE, $category);

                $manager->persist($category);
        }
        $manager->flush();
    }
}
