<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();
        $contact->setPhoneNumber('06 12 34 56 78')
            ->setAdress('1 rue de la République, 14118 Caen')
            ->setEmail('nutrisain@gmail.com')
            ->setPageTitle('Contacts')
            ->setPageText('N\'hésitez pas à me contacter pour toutes questions ou pour prendre rendez-vous !');

        $manager->persist($contact);
        
        $manager->flush();
    }
}
