<?php

namespace App\Tests;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $contact = new Contact();

        $contact->setPhoneNumber('0490049000')
            ->setAdress('adress')
            ->setEmail('email')
            ->setPageTitle('page title')
            ->setPageText('page text');

        $this->assertTrue($contact->getPhoneNumber() === '0490049000');
        $this->assertTrue($contact->getAdress() === 'adress');
        $this->assertTrue($contact->getEmail() === 'email');
        $this->assertTrue($contact->getPageTitle() === 'page title');
        $this->assertTrue($contact->getPageText() === 'page text');
    }

    public function testIsFalse(): void
    {
        $contact = new Contact();

        $contact->setPhoneNumber('0490049000')
            ->setAdress('adress')
            ->setEmail('email')
            ->setPageTitle('page title')
            ->setPageText('page text');

        $this->assertFalse($contact->getPhoneNumber() === 'false');
        $this->assertFalse($contact->getAdress() === 'false');
        $this->assertFalse($contact->getEmail() === 'false');
        $this->assertFalse($contact->getPageTitle() === 'false');
        $this->assertFalse($contact->getPageText() === 'false');
    }

    public function testIsEmpty(): void
    {
        $contact = new Contact();

        $this->assertEmpty($contact->getPhoneNumber());
        $this->assertEmpty($contact->getAdress());
        $this->assertEmpty($contact->getEmail());
        $this->assertEmpty($contact->getPageTitle());
        $this->assertEmpty($contact->getPageText());
    }
}
