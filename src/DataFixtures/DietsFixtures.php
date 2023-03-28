<?php

namespace App\DataFixtures;

use App\Entity\Diets;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DietsFixtures extends Fixture
{
    public const DIET_REFERENCE = 'diet';

    public function load(ObjectManager $manager): void
    {
        $names = [
            'Végétarien',
            'Végétalien',
            'Sans gluten',
            'Sans lactose',
            'Sans sel',
            'Anti-cholestérol',
            'Détox',
        ];

        for ($i=1; $i <= 7 ; $i++) {
            $diet = new Diets();

            $diet->setName($names[$i-1]);
            $this->setReference(SELF::DIET_REFERENCE, $diet);

                $manager->persist($diet);
        }
        $manager->flush();
    }
}
