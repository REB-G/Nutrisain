<?php

namespace App\DataFixtures;

use App\Entity\Difficulties;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DifficultiesFixtures extends Fixture
{
    public const DIFFICULTY_REFERENCE = 'difficulty';

    public function load(ObjectManager $manager): void
    {
        $names = [
            'Facile',
            'Moyen',
            'Difficile',
        ];

        for ($i=1; $i <= 3 ; $i++) {
            $difficulty = new Difficulties();

            $difficulty->setName($names[$i-1]);
            $this->setReference(SELF::DIFFICULTY_REFERENCE, $difficulty);

                $manager->persist($difficulty);
        }
        $manager->flush();
    }
}
