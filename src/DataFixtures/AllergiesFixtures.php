<?php

namespace App\DataFixtures;

use App\Entity\Allergies;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AllergiesFixtures extends Fixture
{
    public const ALLERGY_REFERENCE = 'allergy';

    public function load(ObjectManager $manager): void
    {
        $names = [
            'Aucune',
            'Gluten',
            'Moutarde',
            'Crustacés',
            'Oeufs',
            'Poissons',
            'Arachide',
            'Lactose',
            'Graines de sésame',
            'Soja',
            'Fruits à coque',
        ];
        for ($i=1; $i <=11; $i++) {
            $allergy = new Allergies();

            $allergy->setName($names[$i-1]);
            $this->setReference(SELF::ALLERGY_REFERENCE, $allergy);

            $manager->persist($allergy);
        }
        $manager->flush();
    }
}
